<?php namespace carefulcollab\helpers;
use \PDO;
use PDOException;
use DBConfig;

require_once("DBConnect.php");

class DataHelper
{

    private const DSN = 'mysql:host='.DBConfig::DB_HOST.';dbname='.DBConfig::DB_NAME.';charset=utf8mb4';
    private const DB_USER = DBConfig::DB_USER;
    private const DB_PASSWORD = DBConfig::DB_PASSWORD;

    
    public static function updateTeamProfile($wpUserId, $descripton,$skills)
    {
        $result=new DataResult();

        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            if (isset($team['id']))
            {
                $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);
                if (!isset($team['description'])) 
                {
                    self::addPointsToTeam($team['id'],20,$pdo);
                    $result->pointsAdded=20;
                }
                $sql=("INSERT INTO cc_team_profiles (team_id,description,skills,created_date,created_by, approved_date,approved_by) VALUES (?,?,?,now(),?,?,?)");
                $pdo->prepare($sql)->execute([$team['id'], $descripton,$skills,$wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy]);
                $result->wasSuccessful=true;
                $pdo->commit();
            }
        }
        catch (\PDOException $e)
        {
             $result=self::getResultForException($result,$e); 
             $pdo->rollBack();
        }
        return $result;
    } 

    public static function getTeamByTeamId($teamId)
    {
        $pdo=self::getPDOConnection();

        $stmt = $pdo->prepare("SELECT * FROM cc_all_teams_approved WHERE id=?");
        $stmt->execute([$teamId]); 
        $team = $stmt->fetch();
        return $team;
    }

    public static function getTeamsByAreaId($areaId)
    {
        $pdo=self::getPDOConnection();

        $stmt = $pdo->prepare("SELECT * FROM cc_all_teams_approved WHERE area_id=?");
        $stmt->execute([$areaId]); 
        $teams = $stmt->fetchAll();
        return $teams;
    }


    public static function getTeamsOrderByPoints($areaId, $countryId, $skillsetName)
    {

        $conditions = [];
        $parameters = [];

        if ($areaId!='All')
        {
            $conditions[] = 'area_id=?';
            $parameters[] = $areaId;
        }

        if ($countryId!='All')
        {
            $conditions[] = 'country_id=?';
            $parameters[] = $countryId;
        }


        if ($skillsetName!='All')
        {
            $conditions[] = 'skills LIKE ?';
            $parameters[] = '%' . $skillsetName . '%';
        }

        $sql="SELECT * FROM cc_all_teams_approved";

        if ($conditions)
        {
            $sql .= " WHERE ".implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY points DESC";


        $pdo=self::getPDOConnection();

        $stmt = $pdo->prepare($sql);
        $stmt->execute($parameters); 
        $teams = $stmt->fetchAll();
        return $teams;
    }

    public static function getTeamByWPUserId($wpUserId)
    {
        $pdo=self::getPDOConnection();
        return self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
  
    }

    private static function getTeamByTeamIdUsingPDO($teamId, $pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM cc_all_teams_approved WHERE id=?");
        $stmt->execute([$teamId]); 
        $team = $stmt->fetch();
        return $team;
    }

    private static function getTeamByWPUserIdUsingPDO($wpUserId, $pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM cc_teams_by_user WHERE wp_user_id=?");
        $stmt->execute([$wpUserId]); 
        $team = $stmt->fetch();
        return $team;
    }

    public static function updateTeamChallenge($wpUserId, $areaId, $challengeId, $bespokeChallenge)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            //$points=$team['points'];

            if (isset($team['id']))
            {
                if (!empty($bespokeChallenge))
                {
                    $sql=("INSERT INTO cc_challenges (area_id, name, show_for_all) VALUES (?,?,0)");
                    $pdo->prepare($sql)->execute([$areaId, $bespokeChallenge]);
                    $challengeId = $pdo->lastInsertId();
                    $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);
                }
                else
                {
                    $approvalDetails=new ApprovalDetails();
                    $approvalDetails->approvedDate=date('Y-m-d H:i:s');
                    $approvalDetails->approvedBy=$wpUserId;
                }
                if (!isset($team['challenge_id'])) 
                {
                    self::addPointsToTeam($team['id'],20,$pdo);
                    $result->pointsAdded=20;
                }
                //$result= self::updateChallenge($pdo, $wpUserId, $team['id]'],$team['role'], $areaId,$challengeId,true);
                $sql=("INSERT INTO cc_team_challenges (team_id, area_id, challenge_id,bespoke_challenge, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,now(),?,?,?)");
                $pdo->prepare($sql)->execute([$team['id'], $areaId, $challengeId, $bespokeChallenge, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy]);
                $result->wasSuccessful=true;
            }
            $pdo->commit();

        }
        catch (\PDOException $e)
        {
             $result=self::getResultForException($result,$e); 
             $pdo->rollBack();
        }
        return $result;
    }

    
    public static function getAreasToInvestigate()
    {
        $pdo = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        return $pdo->query("SELECT id,name,description FROM cc_areas")->fetchAll();        
    }

    public static function getAreasWithAvailableChallenges($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt=$pdo->prepare("SELECT DISTINCT cca.* FROM cc_areas cca JOIN cc_challenges ccc ON (cca.id=ccc.area_id OR cca.id=area_id2  OR cca.id=area_id3  OR cca.id=area_id4  OR cca.id=area_id5) WHERE (ccc.country_id=? OR ccc.show_for_all=1) ORDER BY cca.id");
        $stmt->execute([$team['country_id']]);
        return $stmt->fetchAll();        
    }

    public static function getAreaToInvestigate($areaId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt= $pdo->prepare("SELECT id,name,description FROM cc_areas WHERE id=?");
        $stmt->execute([$areaId]);
        return $stmt->fetch();         
    }

    public static function getChallengesInArea($wpUserId, $areaId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt= $pdo->prepare("SELECT * FROM cc_challenges WHERE (area_id=? OR area_id2=? OR area_id3=? OR area_id4=? OR area_id5=?) AND (country_id=? OR show_for_all=1)");
        $stmt->execute([$areaId, $areaId,$areaId,$areaId,$areaId,$team['country_id']]);
        return $stmt->fetchAll();         
    }

    public static function getNUPs()
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt= $pdo->prepare("SELECT title,description FROM cc_NUPs ORDER BY id");
        $stmt->execute();
        return $stmt->fetchAll();         
    }


    public static function updateTeamWithStatementAndContext($wpUserId, $statementOfIntent, $context)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            if ((!isset($team['context'])||empty($team['context'])&&!empty($context))) 
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            $sql=("INSERT INTO cc_team_challenge_definitions (team_id, challenge_id,statement_of_intent, context, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,now(),?,?,?)");       
            $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $statementOfIntent, $context, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
    return $result;
    } 

    
    public static function getFunctionsByTeamAndChallengeId($teamId,$challengeId,$approvedOnly)
    {
        $addApproved="";
        if ($approvedOnly===true) $addApproved="_approved";
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT id,function_number, name, biologized_question FROM cc_all_functions" .$addApproved. " WHERE team_id=? AND challenge_id=?");
        $stmt->execute([$teamId,$challengeId]); 
        $functions = $stmt->fetchAll();
        return $functions;
    }



    public static function updateTeamWithFunction($wpUserId, $functions)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            
            //check if this is the first function entered.  If so, add 20 points
            $stmt = $pdo->prepare("SELECT COUNT(*) AS number_of_functions FROM cc_all_functions WHERE team_id=? AND challenge_id=?");
            $stmt->execute([$team['id'],$team['challenge_id']]);
            $checkFunctions=$stmt->fetch();
            if ($checkFunctions['number_of_functions']==0&&count($functions)>0) 
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }
            
            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            foreach($functions as $function)
            {
                $sql=("INSERT INTO cc_team_functions (team_id, challenge_id, function_number, name, biologized_question, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,?,now(),?,?,?)");
                $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $function->functionNumber, $function->functionName, $function->biologizedQuestion, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy]);
            }
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }  

    public static function updateTeamWithNaturalStrategies($wpUserId, $strategies)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);

            //check if this is the first strategy entered.  If so, add 20 points
            $stmt = $pdo->prepare("SELECT COUNT(*) AS number_of_strategies FROM cc_all_strategies WHERE team_id=? AND challenge_id=?");
            $stmt->execute([$team['id'],$team['challenge_id']]);
            $checkStrategies=$stmt->fetch();
            if ($checkStrategies['number_of_strategies']==0&&count($strategies)>0) 
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            foreach($strategies as $strategy)
            {
                $strategyNumber=$strategy->strategyNumber;                
                $strategyName=$strategy->strategyName;
                $designPrinciple=$strategy->designPrinciple;
                $functionNumber=$strategy->functionNumber;
                $sql=("INSERT INTO cc_team_natural_strategies (team_id, challenge_id, function_number, strategy_number, design_principle, strategy_name, created_date,created_by, approved_date, approved_by ) VALUES (?,?,?,?,?,?,now(),?,?,?)");
                $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $functionNumber, $strategyNumber, $designPrinciple, $strategyName, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy]);
            }

            $pdo->commit();
            $result->wasSuccessful=true;
        }      
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }  

    
    public static function getNaturalStrategiesByFunctionNumber($wpUserId, $functionNumber,$approvedOnly)
    {
        $addApproved="";
        if ($approvedOnly===true) $addApproved="_approved";
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT strategy_name,design_principle FROM cc_all_strategies" .$addApproved. " WHERE team_id=? AND challenge_id=? AND function_number=?");        
        $stmt->execute([$team['id'],$team['challenge_id'],$functionNumber]); 
        $naturalStrategies = $stmt->fetchAll();

        return $naturalStrategies;
    }

    public static function getNaturalStrategiesByFunctionNumberAndTeamId($teamId, $functionNumber, $approvedOnly)
    {
        $addApproved="";
        if ($approvedOnly===true) $addApproved="_approved";
        $pdo=self::getPDOConnection();
        $team=self::getTeamByTeamIdUsingPDO($teamId,$pdo);
        $stmt = $pdo->prepare("SELECT strategy_name,design_principle FROM cc_all_strategies" .$addApproved. " WHERE team_id=? AND challenge_id=? AND function_number=?");        
        $stmt->execute([$teamId,$team['challenge_id'],$functionNumber]); 
        $naturalStrategies = $stmt->fetchAll();
        return $naturalStrategies;
    }

    public static function getDesignPrincipleByFunctionId($functionId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT name FROM cc_team_design_principles WHERE function_id=?");        
        $stmt->execute([$functionId]); 
        $designPrinciple = $stmt->fetch();

        return $designPrinciple;
    }  


    public static function updateTeamWithDesignIdea($wpUserId, $designIdeaFile, $designIdeaUrl, $designIdeaYouTubeId)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            if ((!isset($team['design_idea_url'])||empty($team['design_idea_url']))&&(!empty($designIdeaFile)||!empty($designIdeaYouTubeId))) 
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            $sql=("INSERT INTO cc_team_design_ideas (team_id, challenge_id,design_idea_file,design_idea_url, design_idea_you_tube_id, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,?,now(),?,?,?)");       
            $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $designIdeaFile, $designIdeaUrl, $designIdeaYouTubeId, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    } 

    public static function updateTeamWithMeasures($wpUserId, $recommendations)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            if ((!isset($team['recommendations'])||empty($team['design_idea_url']))&&(!empty($recommendations))) 
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            $sql=("INSERT INTO cc_team_measures (team_id, challenge_id,recommendations, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,now(),?,?,?)");       
            $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $recommendations, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    } 

    public static function updateTeamWithBusinessCanvas($wpUserId, $valueProposition, $customers, $supporters, $income, $happen, $pitchVideoUrl, $pitchVideoYouTubeId)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            if ((!isset($team['value_proposition'])||empty($team['value_proposition']))&&!empty($valueProposition))
            {
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded=20;
            }

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            $sql=("INSERT INTO cc_team_business_canvas (team_id, challenge_id,value_proposition,customers, supporters, income, happen, pitch_video_url, pitch_video_you_tube_id,created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,?,?,?,?,?,now(),?,?,?)");       
            $pdo->prepare($sql)->execute([$team["id"], $team['challenge_id'], $valueProposition, $customers, $supporters, $income, $happen, $pitchVideoUrl, $pitchVideoYouTubeId, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    } 


    public static function addResourcesToCommons($wpUserId, $resources, $phaseType,$collaborationPointType)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            foreach($resources as $resource)
            {

                $sql=("INSERT INTO cc_commons_resources (team_id, country_id, phase_type, collaboration_point_type, title, description, url, file_upload_url, created_date,created_by, approved_date, approved_by ) VALUES (?,?,?,?,?,?,?,?,now(),?,?,?)");
                $pdo->prepare($sql)->execute([$team["id"], $team['country_id'],$phaseType, $collaborationPointType, $resource->title, $resource->description, $resource->url, $resource->fileUploadURL, $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy]);
                self::addPointsToTeam($team['id'],20,$pdo);
                $result->pointsAdded+=20;
            }

            $pdo->commit();
            $result->wasSuccessful=true;
        }      
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }  

    public static function getResourcesFromCommons($wpUserId, $phaseType, $collaborationPointType, $countryId, $recommendedFilter)
    {

        $conditions = [];
        $parameters = [];

        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);

        $conditions[]="(approved_date IS NOT null OR team_id=?)";
        $parameters[]= $team['id'];
        $conditions[] = "rejected_date IS null";

        if ($phaseType!='All')
        {
            $conditions[] = 'phase_type=?';
            $parameters[] = $phaseType;
        }

        if ($collaborationPointType!='All')
        {
            $conditions[] = 'collaboration_point_type=?';
            $parameters[] = $collaborationPointType;
        }
        if ($countryId!='All')
        {
            $conditions[] = 'country_id=?';
            $parameters[] = $countryId;
        }

        if ($recommendedFilter!='All')
        {
            $conditions[] = 'recommended=?';
            $parameters[] = 1;
        }
        $sql="SELECT * FROM cc_all_commons_resources";

        if ($conditions)
        {
            $sql .= " WHERE ".implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY phase_order, collaboration_order";


        $stmt = $pdo->prepare($sql);
        $stmt->execute($parameters); 
        $resources = $stmt->fetchAll();

        return $resources;
    }  

    public static function getResourcesFromCommonsForTeam($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT * FROM cc_all_commons_resources WHERE team_id=? AND rejected_date IS null ORDER BY phase_order, collaboration_order");        
        $stmt->execute([$team['id']]); 
        $resources = $stmt->fetchAll();

        return $resources;
    }  

    public static function getResourcesFromCommonsByTeamId($teamId, $approvedOnly)
    {
        $pdo=self::getPDOConnection();
        $addDpproved="";
        if ($approvedOnly)
            $addApproved=" AND approved_date IS NOT null";
        $stmt = $pdo->prepare("SELECT * FROM cc_all_commons_resources WHERE team_id=? ".$addApproved. " AND rejected_date IS null ORDER BY phase_order, collaboration_order");        
        $stmt->execute([$teamId]); 
        $resources = $stmt->fetchAll();

        return $resources;
    }  
    public static function setCommonsResourceRecommendation($wpUserId, $resourceId, $recommended)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_commons_resources SET recommended=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$recommended,$resourceId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to recommend a resource";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function addComment($wpUserId, $contentType, $contentId, $comment)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
            
            //add 15 points for the team who are commenting
            self::addPointsToTeam($team['id'],15,$pdo);
            $result->pointsAdded=15;

            //add 20 points for the team whose content is being commented on
            $contentTypeTable=self::getTableNameForContentType($contentType,$pdo);
            $stmt = $pdo->prepare("SELECT team_id FROM ". $contentTypeTable . " WHERE id=?"); 
            $stmt->execute([$contentId]);
            $otherTeam=$stmt->fetch();
            self::addPointsToTeam($otherTeam['team_id'],20,$pdo);
            $result->pointsAddedOtherTeam=20;

            $approvalDetails=self::getApprovalDetails($wpUserId,$team['role']);

            $sql=("INSERT INTO cc_comments (team_id, content_type,content_id, comment, team_commented_on, created_date,created_by, approved_date, approved_by) VALUES (?,?,?,?,?,now(),?,?,?)");       
            $pdo->prepare($sql)->execute([$team['id'],$contentType, $contentId, $comment, $otherTeam['team_id'], $wpUserId,$approvalDetails->approvedDate,$approvalDetails->approvedBy] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    } 

    public static function addAppreciation($wpUserId, $contentType, $contentId)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);


            //add 15 points for the team whose content is being appreciated
            $contentTypeTable=self::getTableNameForContentType($contentType,$pdo);
            $stmt = $pdo->prepare("SELECT team_id FROM ". $contentTypeTable . " WHERE id=?"); 
            $stmt->execute([$contentId]);
            $otherTeam=$stmt->fetch();
            if (!$team['id']==$otherTeam['team_id'])
            {
                self::addPointsToTeam($otherTeam['team_id'],15,$pdo);
                $result->pointsAddedOtherTeam=15;
                //add 5 points to the team who is appreciating the content (if they haven't already done so)
                $stmt=$pdo->prepare("SELECT id FROM cc_appreciations WHERE content_type=? AND content_id=?");
                $stmt->execute([$contentType,$contentId]);
                $checkForExistingAppreciation=$stmt->fetch();
                if (!($checkForExistingAppreciation))
                {
                    self::addPointsToTeam($team['id'],5,$pdo);
                    $result->pointsAdded=5;
                }
            }
            $sql=("INSERT INTO cc_appreciations (team_id, content_type,content_id, team_appreciated, created_date,created_by) VALUES (?,?,?,?,now(),?)");       
            $pdo->prepare($sql)->execute([$team['id'],$contentType, $contentId, $otherTeam['team_id'], $wpUserId] );
            $pdo->commit();
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    } 

    public static function getCommentsByContentId($wpUserId, $contentType, $contentId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT cc.id,cc.team_id, ct.name AS team_name, cc.content_type,cc.content_id, cc.comment 
            FROM cc_comments cc JOIN cc_teams ct ON cc.team_id=ct.id WHERE content_type=? AND content_id=? AND ct.id=?
            UNION ALL
            SELECT cc.id,cc.team_id, ct.name AS team_name, cc.content_type,cc.content_id, cc.comment 
            FROM cc_comments cc JOIN cc_teams ct ON cc.team_id=ct.id WHERE cc.approved_date IS NOT null AND content_type=? AND content_id=? AND NOT ct.id=? ");        
        $stmt->execute([$contentType, $contentId, $team['id'],$contentType, $contentId, $team['id']]); 
        $comments = $stmt->fetchAll();

        return $comments;
    }  

    public static function getAppreciationsByContentId($wpUserId, $contentType, $contentId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT ca.team_id, ct.name AS team_name, ca.content_type,ca.content_id 
            FROM cc_appreciations ca JOIN cc_teams ct ON ca.team_id=ct.id WHERE content_type=? AND content_id=? AND ct.id=?");        
        $stmt->execute([$contentType, $contentId, $team['id']]); 
        $appreciations = $stmt->fetchAll();

        return $appreciations;
    }  

    public static function getLatestAppreciations($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT  ct.id as team_id, ct.name AS team_name, ca.content_type,ca.created_date 
            FROM cc_appreciations ca JOIN cc_teams ct ON ca.team_id=ct.id WHERE ca.team_appreciated=? ORDER BY created_date DESC LIMIT 3");        
        $stmt->execute([ $team['id']]); 
        $appreciations = $stmt->fetchAll();

        return $appreciations;
    }  

    public static function getLatestComments($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT ct.id as team_id, ct.name AS team_name, cc.comment, cc.content_type,cc.created_date 
            FROM cc_comments cc JOIN cc_teams ct ON cc.team_id=ct.id WHERE (cc.approved_date IS NOT null OR cc.id=?) AND cc.team_commented_on=? ORDER BY created_date DESC LIMIT 3");        
        $stmt->execute([ $team['id'],$team['id']]); 
        $comments = $stmt->fetchAll();

        return $comments;
    }  


    public static function getComments($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT cc.id, ct.id as team_id, ct.name AS team_name, cc.comment, cc.content_type,cc.created_date 
            FROM cc_comments cc JOIN cc_teams ct ON cc.team_id=ct.id WHERE (cc.approved_date IS NOT null OR cc.id=?) AND cc.team_commented_on=? ORDER BY created_date DESC");        
        $stmt->execute([ $team['id']]); 
        $comments = $stmt->fetchAll();

        return $comments;
    }  

    private static function addPointsToTeam($teamId, $points, $pdo)
    {
        $sql=("UPDATE cc_teams SET points=ifnull(points,0)+? WHERE id=?");
        $pdo->prepare($sql)->execute([$points, $teamId]);
    }

    public static function getPhaseByCountryId($phaseType, $countryId)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_phases WHERE country_id=? AND phase_type=?");        
        $stmt->execute([$countryId,$phaseType]); 
        $phase = $stmt->fetch();
        return $phase;
    }

    public static function getPhaseTitle($wpUserId,$phaseType)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT * FROM cc_phases WHERE country_id=? AND phase_type=?");        
        $stmt->execute([$team['country_id'],$phaseType]); 
        $phase = $stmt->fetch();
        return $phase;
    }


    public static function getPhasesByCountryId($countryId)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT ccp.*, ccps.id AS phase_number, ccps.image_attribution FROM cc_phases ccp JOIN cc_phase_structure ccps ON ccp.phase_type=ccps.phase_type WHERE ccp.country_id=? ORDER BY ccps.id");        
        $stmt->execute([$countryId]); 
        $phases = $stmt->fetchAll();
        return $phases;
    }

    public static function getPhaseByWpPostId($wpPostId)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT ccp.*, ccps.id AS phase_number, ccps.image_attribution FROM cc_phases ccp JOIN cc_phase_structure ccps ON ccp.phase_type=ccps.phase_type WHERE wp_post_id=?");        
        $stmt->execute([$wpPostId]); 
        $phases = $stmt->fetch();
        return $phases;
    }


    public static function getNextPhase($wpUserId,$currentPhaseType)
    {

        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT * FROM cc_phases WHERE country_id=? AND phase_type=? ");        
        $stmt->execute([$team['country_id'],$currentPhaseType]); 
        $currentPhase = $stmt->fetch();
        $stmt = $pdo->prepare("SELECT * FROM cc_phases WHERE country_id=? AND order_number>? ORDER BY order_number ASC ");        
        $stmt->execute([$team['country_id'],$currentPhase['order_number']]); 
        $nextPhase = $stmt->fetch();
        return $nextPhase;
    } 

    public static function getSkillsets()
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_skill_sets");        
        $stmt->execute(); 
        $skillSets = $stmt->fetchAll();
        return $skillSets;
    } 

    public static function getCollaborationPointStructure()
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_collaboration_point_structure ORDER BY id");        
        $stmt->execute(); 
        $collaborationPoints = $stmt->fetchAll();
        return $collaborationPoints;
    }

    public static function getCollaborationPointsBySectionId($wpUserId, $sectionId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT ccp.phase_type,ccp.collaboration_point_type,ccps.name FROM cc_collaboration_points ccp JOIN cc_collaboration_point_structure ccps ON ccp.phase_type=ccps.phase_type AND ccp.collaboration_point_type=ccps.collaboration_point_type WHERE display_in_section=? AND ccp.country_id=? ORDER BY ccps.id ASC");        
        $stmt->execute([$sectionId, $team['country_id']]); 
        $collaborationPoints = $stmt->fetchAll();
        return $collaborationPoints;
    }
    
    public static function getCollaborationPointByName($collaborationPointName)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_collaboration_points WHERE name=?");        
        $stmt->execute([$collaborationPointName]); 
        $collaborationPoint = $stmt->fetch();
        return $collaborationPoint;
    }

    public static function getCollaborationPointByTypeAndCountry($collaborationPointType,$countryId)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT ccp.id, ccp.phase_type,ccp.collaboration_point_type,ccps.name,ccp.display_in_section FROM cc_collaboration_points ccp JOIN cc_collaboration_point_structure ccps ON ccp.phase_type=ccps.phase_type AND ccp.collaboration_point_type=ccps.collaboration_point_type WHERE ccp.collaboration_point_type=? AND country_id=?");        
        $stmt->execute([$collaborationPointType,$countryId]); 
        $collaborationPoint = $stmt->fetch();
        return $collaborationPoint;
    }

    public static function getFurtherCollaborationPointForSameLesson($collaborationPointId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT ccp.display_in_section, ccps.id AS structure_id FROM cc_collaboration_points ccp JOIN cc_collaboration_point_structure ccps ON ccp.phase_type=ccps.phase_type AND ccp.collaboration_point_type=ccps.collaboration_point_type WHERE ccp.id=?");        
        $stmt->execute([$collaborationPointId]); 
        $collaborationPoint = $stmt->fetch();

        $stmt = $pdo->prepare("SELECT ccp.id, ccp.phase_type,ccp.collaboration_point_type,ccps.name,ccp.display_in_section FROM cc_collaboration_points ccp JOIN cc_collaboration_point_structure ccps ON ccp.phase_type=ccps.phase_type AND ccp.collaboration_point_type=ccps.collaboration_point_type WHERE ccp.display_in_section=? AND ccps.id>? ORDER BY ccps.id ASC");
        $stmt->execute([ $collaborationPoint['display_in_section'], $collaborationPoint['structure_id']]);
        $collaborationPoint = $stmt->fetch();
        return $collaborationPoint;
    }


    public static function getCollaborationPointsByPhaseType($wpUserId,$phaseType)
    {
        //NOTE: does not return Review points, just Collaboration points
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT ccp.phase_type,ccp.collaboration_point_type,ccps.name FROM cc_collaboration_points ccp JOIN cc_collaboration_point_structure ccps ON ccp.phase_type=ccps.phase_type AND ccp.collaboration_point_type=ccps.collaboration_point_type WHERE ccp.phase_type=? AND country_id=? AND NOT ccp.collaboration_point_type='REVIEW' ORDER BY ccps.id");        
        $stmt->execute([$phaseType,$team['country_id']]); 
        $collaborationPoint = $stmt->fetchAll();
        return $collaborationPoint;
    }

    public static function insertCollaborationPoint($wpUserId, $phaseType, $collaborationPointType, $lessonId)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("INSERT INTO cc_collaboration_points (country_id,phase_type,collaboration_point_type, display_in_section) VALUES (?,?,?,?)");       
                $pdo->prepare($sql)->execute([$team['country_id'], $phaseType, $collaborationPointType, $lessonId]);
                $result->wasSuccessful=true;
            }
            else
            {
                $result->errorMessage="You do not have permission to insert the collaboration point";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function updateCollaborationPoint($wpUserId, $collabPointId, $lessonId)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                

                $sql=("UPDATE cc_collaboration_points SET display_in_section=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$lessonId, $collabPointId]);
                $result->wasSuccessful=true;
            }
            else
            {
                $result->errorMessage="You do not have permission to update the collaboration point";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function getCompletionByWpPostId($wpUserId, $wpPostId)
    {
        $pdo=self::getPDOConnection();

        $currentPhase=self::getPhaseByWpPostId($wpPostId);
        return self::getCompletionByPhaseType($wpUserId, $currentPhase['phase_type']);
    }

    public static function getCompletionByPhaseType($wpUserId, $phaseType)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT ctpc.phase_type, IFNULL(SUM(percent),0) AS percent_complete,MAX(ccps.image_attribution) FROM cc_phases cp JOIN cc_phase_structure ccps ON cp.phase_type=ccps.phase_type JOIN cc_team_phase_completion ctpc ON cp.phase_type=ctpc.phase_type WHERE team_id=? AND country_id=? AND cp.phase_type=?");        
        $stmt->execute([$team['id'],$team['country_id'],$phaseType]); 
        $completion = $stmt->fetch();
        return $completion;
    }


    public static function getCompletionByPhaseTypeForTeam($teamId, $phaseType)
    {
        $pdo=self::getPDOConnection();
        $stmt = $pdo->prepare("SELECT IFNULL(SUM(percent),0) AS percent_complete FROM cc_team_phase_completion WHERE team_id=? AND phase_type COLLATE utf8mb4_general_ci=?");        
        $stmt->execute([$teamId,$phaseType]); 
        $completion = $stmt->fetch();
        return $completion;
    }

    public static function getCompletionByCollaborationPointTypeForTeam($wpUserId, $collaborationPointType)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt = $pdo->prepare("SELECT percent FROM cc_team_phase_completion WHERE team_id=? AND collaboration_point_type COLLATE utf8mb4_general_ci=?");        
        $stmt->execute([$team['id'],$collaborationPointType]); 
        $completion = $stmt->fetch();
        return $completion;
    }

    public static function getReviewPointByPhaseTypeAndCountry($collaborationPointType,$phaseType,$countryId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_collaboration_points WHERE collaboration_point_type=? AND phase_type=? AND country_id=?");        
        $stmt->execute([$collaborationPointType,$phaseType, $countryId]); 
        $reviewPoint = $stmt->fetch();
        return $reviewPoint;
    }

    public static function getExitReviewPointByCountry($countryId)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_collaboration_points WHERE collaboration_point_type='EXIT' AND country_id=?");        
        $stmt->execute([$countryId]); 
        $reviewPoint = $stmt->fetch();
        return $reviewPoint;
    }

    public static function getPhaseReviewQuestionsByPhaseType($phaseType)
    {

        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_phase_review_questions WHERE phase_type=? ORDER BY order_number_within_phase");        
        $stmt->execute([$phaseType]); 
        $questions = $stmt->fetchAll();
        return $questions;
    } 

    public static function addPhaseReviewResponse($wpUserId, $phaseType, $phaseReviewResponses)
    {
        $result=new DataResult();
        try
        {
            $pdo=self::getPDOConnection();
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);

            foreach($phaseReviewResponses as $response)
            {
                if ($response->numericResponse)
                {
                    $sql=("INSERT INTO cc_team_phase_review_responses (team_id, phase_type, phase_review_question_id, numeric_response, created_date) VALUES (?,?,?,?, now())");       
                    $pdo->prepare($sql)->execute([$team['id'],$phaseType,$response->questionId, $response->numericResponse] );
                }  
                if ($response->textResponse)
                {
                    $sql=("INSERT INTO cc_team_phase_review_responses (team_id, phase_type, phase_review_question_id, text_response, created_date) VALUES (?,?,?,?, now())");       
                    $pdo->prepare($sql)->execute([$team['id'],$phaseType,$response->questionId, $response->textResponse] );
                }  
            }
            self::addPointsToTeam($team['id'],5,$pdo);
            $pdo->commit();
            $result->pointsAdded=5;
            $result->wasSuccessful=true;

        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }    

    public static function getGlossary()
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_glossary");        
        $stmt->execute(); 
        $glossary = $stmt->fetchAll();
        return $glossary;
    }  

    public static function getGlossaryById($glossaryId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_glossary WHERE id=?");
        $stmt->execute([$glossaryId]);      
        $glossary= $stmt->fetchAll();
        return $glossary;
    }  


    public static function getModerationQueue($wpUserId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);
        $stmt = $pdo->prepare("SELECT * FROM cc_moderation_queue WHERE location_id=? ORDER BY created_date");       
        $stmt->execute([$team['location_id']]); 
        $moderationQueue = $stmt->fetchAll();
        return $moderationQueue;
    }  

    public static function getModerationContent($contentType, $contentId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $tableToSelect=self::getTableNameForContentType($contentType,$pdo);
        $stmt = $pdo->prepare("SELECT * FROM " . $tableToSelect ." WHERE id=?");       
        $stmt->execute([$contentId]); 
        $moderationContent = $stmt->fetch();
        return $moderationContent;
    }  


    public static function approveAllContent($wpUserId)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserId($wpUserId);
            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                
                $moderationQueue=self::getModerationQueue($wpUserId);
                foreach($moderationQueue as $item)
                {
                    $contentType=$item['content_type'];
                    $contentId=$item['content_id'];
                    $tableToUpdate=self::getTableNameForContentType($contentType,$pdo);
                    if (!empty($tableToUpdate))
                    {
                        $sql=("UPDATE " . $tableToUpdate ." SET approved_by=?,approved_date=now() WHERE id=?");
                        $pdo->prepare($sql)->execute([$wpUserId, $contentId]);
                    }
                }
                $pdo->commit();
                $result->wasSuccessful=true;

            }
            else
            {
                $result->errorMessage="You do not have permission to approve the content";
                $pdo->rollBack();
                $result->wasSuccessful=false;
            }
        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }

    public static function approveContent($wpUserId,$contentType, $contentId)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);
            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $tableToUpdate=self::getTableNameForContentType($contentType,$pdo);
                if (!empty($tableToUpdate))
                {
                    $sql=("UPDATE " . $tableToUpdate ." SET approved_by=?,approved_date=now() WHERE id=?");
                    $pdo->prepare($sql)->execute([$wpUserId, $contentId]);
                    $result->wasSuccessful=true;
                }
            }
            else
            {
                $result->errorMessage="You do not have permission to approve the content";
                $result->wasSuccessful=false;
            }
        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }  

    public static function rejectContent($wpUserId,$contentType, $contentId)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);
            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $tableToUpdate=self::getTableNameForContentType($contentType,$pdo);

                if (!empty($tableToUpdate))
                {
                    $sql=("UPDATE " . $tableToUpdate ." SET rejected_by=?,rejected_date=now() WHERE id=?");             
                    $pdo->prepare($sql)->execute([$wpUserId, $contentId]);
                    $result->wasSuccessful=true;
                }
            }
            else
            {
                $result->errorMessage="You do not have permission to reject the content";
                $result->wasSuccessful=false;
            }
        }
        catch (\PDOException $e)
        {
            $result=self::getResultForException($result,$e); 
            $pdo->rollBack();
        }
        return $result;
    }  


    public static function getChallengesForCountry($wpUserId)
    {
        $pdo=self::getPDOConnection();
        $team=self::getTeamByWPUserIdUsingPDO($wpUserId,$pdo);
        $stmt= $pdo->prepare("SELECT * FROM cc_challenges WHERE country_id=?");
        $stmt->execute([$team['country_id']]);
        return $stmt->fetchAll();         
    }

    public static function hasChallengeBeenUsed($challengeId)
    {
        $pdo=self::getPDOConnection();
        $stmt= $pdo->prepare("SELECT * FROM cc_team_challenges WHERE challenge_id=?");
        $stmt->execute([$challengeId]);
        return $stmt->fetchAll();         
    }

    public static function addChallenge($wpUserId, $challengeName, $challengeDescription, $challengeFurtherInformation, $areaId, $areaId2,$areaId3,$areaId4,$areaId5)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("INSERT INTO cc_challenges (name, description, further_information, area_id, area_id2, area_id3, area_id4, area_id5, country_id, created_date, created_by, approved_date, approved_by) VALUES (?,?,?,?,?,?,?,?,?,now(),?, now(),?)");       
                $pdo->prepare($sql)->execute([$challengeName,$challengeDescription, $challengeFurtherInformation, $areaId, $areaId2,$areaId3,$areaId4,$areaId5, $team['country_id'],$wpUserId, $wpUserId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to add a new challenge";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function updateChallenge($wpUserId, $challengeId, $challengeName, $challengeDescription, $challengeFurtherInformation, $areaId, $areaId2,$areaId3,$areaId4,$areaId5)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_challenges SET name=?, description=?, further_information=?, area_id=?, area_id2=?, area_id3=?, area_id4=?, area_id5=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$challengeName,$challengeDescription, $challengeFurtherInformation, $areaId, $areaId2,$areaId3,$areaId4,$areaId5, $challengeId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to update a challenge";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function removeChallenge($wpUserId, $challengeId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if (self::hasChallengeBeenUsed($challengeId))
            {
                $result->errorMessage="You cannot remove this challenge as it is being used";
                $result->wasSuccessful=false;
                return $result;
            }
            

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                
                $sql=("DELETE FROM cc_challenges WHERE id=?");       
                $pdo->prepare($sql)->execute([$challengeId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to remove a challenge";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }



    public static function getCountries()
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $stmt = $pdo->prepare("SELECT * FROM cc_countries");
        $stmt->execute(); 
        $countries = $stmt->fetchAll();
        return $countries;
    }

    public static function addLocation($wpUserId, $countryId, $locationName, $locationLatitude, $locationLongitude)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("INSERT INTO cc_locations (country_id, name,latitude,longitude, created_date, created_by, approved_date, approved_by) VALUES (?,?,?,?,now(),?, now(),?)");       
                $pdo->prepare($sql)->execute([$countryId, $locationName, $locationLatitude, $locationLongitude, $wpUserId, $wpUserId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to add a new location";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }


    public static function updateLocation($wpUserId, $locationId, $locationName, $locationLatitude, $locationLongitude)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_locations SET name=?, latitude=?,longitude=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$locationName, $locationLatitude, $locationLongitude, $locationId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to add a new location";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function removeLocation($wpUserId, $locationId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $pdo->beginTransaction();
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_locations SET removed=1 WHERE id=?");       
                $pdo->prepare($sql)->execute([$locationId]);

                $sql=("UPDATE cc_teams SET removed=1 WHERE location_id=?");       
                $pdo->prepare($sql)->execute([$locationId]);

                $pdo->commit();
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to remove the location";
                $pdo->rollBack();
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e);
            $pdo->rollBack(); 
        }
        return $result;
    }


    public static function getLocationsByCountry($wpUserId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);

        if ($team['role']=='ADMIN'||$team['role']=="GLOBAL")
        {
            if ($team['role']=='GLOBAL')
            {
                $stmt = $pdo->prepare("SELECT * FROM cc_locations WHERE (removed=0 OR removed is null)");
                $stmt->execute(); 
            }
            else
            {
                $stmt = $pdo->prepare("SELECT * FROM cc_locations WHERE (removed=0 OR removed is null) AND country_id=?"); 
                $stmt->execute([$team['country_id']]); 
            }
            $locations = $stmt->fetchAll();
            return $locations;
        }
        else
            return false;
    }

    public static function getTeamsByRole($wpUserId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);

        if ($team['role']=='TEACHER')
        {
            $stmt = $pdo->prepare("SELECT * FROM cc_teams WHERE location_id=? AND (removed=0 OR removed is null)");       
            $stmt->execute([$team['location_id']]); 
            $teams = $stmt->fetchAll();
            return $teams;
        }

        if ($team['role']=='ADMIN')
        {
            $stmt = $pdo->prepare("SELECT ct.*, cl.name AS location_name FROM cc_teams ct JOIN cc_locations cl ON ct.location_id=cl.id WHERE cl.country_id=? AND (ct.removed=0 OR ct.removed is null) ORDER BY cl.name, ct.name");       
            $stmt->execute([$team['country_id']]); 
            $teams = $stmt->fetchAll();
            return $teams;
        }

        if ($team['role']=='GLOBAL')
        {
            $stmt = $pdo->prepare("SELECT ct.*, concat(cl.name ,',', cc.name) AS location_name FROM cc_teams ct JOIN cc_locations cl ON ct.location_id=cl.id JOIN cc_countries cc ON cl.country_id=cc.id WHERE (ct.removed=0 OR ct.removed is null) ORDER BY cc.name, cl.name, ct.name");       
            $stmt->execute(); 
            $teams = $stmt->fetchAll();
            return $teams;
        }
    }

    public static function getTeamsByLocation($wpUserId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);
        $stmt = $pdo->prepare("SELECT * FROM cc_teams WHERE location_id=? AND (removed=0 OR removed is null)");       
        $stmt->execute([$team['location_id']]); 
        $teams = $stmt->fetchAll();
        return $teams;
    }
    
    public static function addTeam($wpUserId, $teamName, $locationId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("INSERT INTO cc_teams (location_id, name, created_date, created_by, approved_date, approved_by) VALUES (?,?,now(),?, now(),?)");       
                $pdo->prepare($sql)->execute([$locationId,$teamName, $wpUserId, $wpUserId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to add a new team";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function updateTeamName($wpUserId, $teamId, $teamName)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_teams SET name=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$teamName, $teamId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to update the team name";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function removeTeam($wpUserId, $teamId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_teams SET removed=1 WHERE id=?");       
                $pdo->prepare($sql)->execute([$teamId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to remove the team";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function addUser($wpUserId, $teamId, $userName, $userPassword, $role)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $userData = array
                (
                    'user_login' =>  $userName,
                    'first_name' =>  'Team Member',
                    'user_pass'  =>  $userPassword
                );
                $userId = wp_insert_user( $userData );
                if ( ! is_wp_error( $userId ) ) 
                {

                    wp_new_user_notification($userId, null, 'both');

                    $sql=("INSERT INTO cc_users (wp_user_id, team_id, role) VALUES (?,?,?)");       
                    $pdo->prepare($sql)->execute([$userId,$teamId, $role]);

                    $result->wasSuccessful=true;
                    return $result;
                }
                else
                {
                    $result->errorMessage=$userId->get_error_message();
                    $result->wasSuccessful=false;
                }
            }
            else
            {
                $result->errorMessage="You do not have permission to add the user";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
  
    }

    public static function removeUser($wpUserId, $wpUserIdToRemove)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                require_once(ABSPATH.'wp-admin/includes/user.php');
                $response=wp_delete_user( $wpUserIdToRemove );
                if ($response==1)             
                    $result->wasSuccessful=true;
                else
                    $result->wasSuccessful=false;
            }
            else
            {
                $result->errorMessage="You do not have permission to remove the user";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
  
    }

    
    public static function resetUserPassword($wpUserId, $wpUserIdToReset, $userPassword)
    {
        $result=new DataResult();
        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                wp_set_password( $userPassword, $wpUserIdToReset );
                $result->wasSuccessful=true;        }
            else
            {
                $result->errorMessage="You do not have permission to reset the password";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
  
    }


    public static function updateTeamForUser($wpUserId, $userId, $teamId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_users SET team_id=? WHERE id=?");
                $pdo->prepare($sql)->execute([$teamId, $userId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to update the user's team";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function updateLocationForUser($wpUserId, $userId, $locationId)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            if ($team['role']=='TEACHER'||$team['role']=='ADMIN'||$team['role']=="GLOBAL")
            {
                $sql=("UPDATE cc_users SET location_id=? WHERE id=?");       
                $pdo->prepare($sql)->execute([$locationId, $userId]);
                $result->wasSuccessful=true;
                return $result;
            }
            else
            {
                $result->errorMessage="You do not have permission to update the user's team";
                $result->wasSuccessful=false;
            }
        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }

    public static function getUsersByLocation($wpUserId, $role)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);
        $stmt = $pdo->prepare
            ("SELECT cu.id, wu.id as wp_user_id, wu.user_nicename as user_name, cu.team_id ,ct.name as team_name FROM cc_users cu 
                JOIN wp_users wu ON cu.wp_user_id =wu.ID 
                JOIN cc_teams ct ON cu.team_id = ct.id 
                WHERE cu.role =? AND ct.location_id=? ORDER BY ct.name");       
        $stmt->execute([$role, $team['location_id']]); 
        $students = $stmt->fetchAll();
        return $students;
    }

    public static function getTeachersByLocation($wpUserId)
    {
        $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
        $team=self::getTeamByWPUserId($wpUserId);
        $stmt = $pdo->prepare
            ("SELECT cu.id, wu.id as wp_user_id, wu.user_nicename as user_name, cu.team_id ,ct.name as team_name FROM cc_users cu 
                JOIN wp_users wu ON cu.wp_user_id =wu.ID 
                JOIN cc_teams ct ON cu.team_id = ct.id 
                WHERE cu.`role` ='TEACHER' AND ct.location_id=? ORDER BY ct.name");       
        $stmt->execute([$team['location_id']]); 
        $teachers = $stmt->fetchAll();
        return $teachers;
    }

    public static function addPlatformYesNoFeedback($wpUserId, $feedbackYesNo)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN,self::DB_USER,self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            $sql=("INSERT INTO cc_team_feedback (team_id,yes_or_no, created_date, created_by) VALUES (?,?,now(),?)");       
            $pdo->prepare($sql)->execute([$team['id'],$feedbackYesNo, $wpUserId]);
            $result->wasSuccessful=true;
            return $result;

        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }
    public static function addPlatformTextFeedback($wpUserId, $feedbackText)
    {
        $result=new DataResult();

        try
        {
            $pdo = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
            $team=self::getTeamByWPUserId($wpUserId);

            $sql=("INSERT INTO cc_team_feedback (team_id,feedback, created_date, created_by) VALUES (?,?,now(),?)");       
            $pdo->prepare($sql)->execute([$team['id'],$feedbackText, $wpUserId]);
            $result->wasSuccessful=true;
            return $result;

        }
        catch (\Throwable $e)
        {
            $result=self::getResultForException($result,$e); 
        }
        return $result;
    }




/**
 * 
 */

    private static function getPDOConnection()
    {
        $pdo = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $pdo;
    }
  
    private static function getTableNameForContentType($contentType,$pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM cc_content_types WHERE content_type=? ");       
        $stmt->execute([$contentType]); 
        $contentType = $stmt->fetch();
        return $contentType['table_name'];
    }



    private static function getApprovalDetails($wpUserId, $role)
    {
        $details=new ApprovalDetails();
        if ($role==='TEACHER'||$role==='ADMIN'||$role==="GLOBAL")
        {
            $details->approvedDate=date('Y-m-d H:i:s');
            $details->approvedBy=$wpUserId;
        }
        if ($role=="STUDENT") 
        {
            $details->approvedDate=null;
            $details->approvedBy=null;
        }
        return $details;
    }

    private static function getResultForException($result, $exception)
    {
        $result->wasSuccessful=false;
        $result->errorMessage=$exception->getMessage();
        $result->pointsAdded=0;
        return $result;
    }
}


class DataResult
{
    public $wasSuccessful;
    public $errorMessage;
    public $pointsAdded;
    public $pointsAddedOtherTeam;
}


class FunctionAndBiologizedQuestion
{
    public $functionNumber;
    public $functionName;
    public $biologizedQuestion;
}

class NaturalStrategy
{
    public $functionNumber;
    public $strategyNumber;
    public $strategyName;
    public $designPrinciple;
}

class ApprovalDetails
{
    public $approvedDate;
    public $approvedBy;
}

class PhaseReviewResponse
{
    public $questionId;
    public $numericResponse;
    public $textResponse;
}

class CommonsResource
{
    public $title;
    public $description;
    public $url;
    public $fileUploadURL;
}




