<h3><?=t("Commons Resources shared by")?> <?=$viewedTeam['name']?></h3>
<?php 
use carefulcollab\helpers as cchelpers;

$phaseTitle="";
$collaborationPointName="";
$resources = cchelpers\DataHelper::getResourcesFromCommonsByTeamId($viewedTeam['id'], !$editTeam);

if ($resources)
{
    foreach ($resources as $resource)
    {
        $nextPhaseTitle=$resource['phase_title'];        
        if (!($phaseTitle==$nextPhaseTitle))
        {
            $nextPhase=cchelpers\DataHelper::getPhaseTitle($userId,$nextPhaseTitle);
?>
    <h4><?=$nextPhase['phase_title'] ?></h4>
    <?php
            $phaseTitle=$resource['phase_title'];
        }
        $nextCollaborationPointName=$resource['collaboration_point_name'];
        if (!($collaborationPointName==$nextCollaborationPointName))
        {
                //TODO: proper translation needed
                //$nextCollaborationPointPage=getTranslatedPageByTitle($nextCollaborationPointName);
                //if (isset(get_post($nextCollaborationPointPage)->post_title))
                $nextCollaborationPointName=t($collaborationPointName,$collaborationPointName);//get_post($nextCollaborationPointPage)->post_title;
?>
    <h5><?=$nextCollaborationPointName ?></h5>
<?php
            $collaborationPointName=$resource['collaboration_point_name'];
        }
    ?>
    <div class="bg-light border border-primary rounded-3 m-2 p-2">
        <h2><i class="bi bi-file-richtext"></i><?=$resource['title'] ?></h2>

        <?= snippet('show-translatable-content', [ $content=$resource['description']]) ?>
        <?php 
        if (!empty($resource['url'])) 
        { 
            $resourceUrl=str_replace("https://","",$resource['url']);
        ?>
        <p><b><?=t("Website Link")?>: </b> <a href="https://<?=$resourceUrl ?>" target="_blank"><?=$resourceUrl?></a></p>
        <?php 
        }
        if (!empty($resource['file_upload_url'])) 
        { 
            snippet('show-file', [ 'fileUrl'=>$resource['file_upload_url'],'altText'=>$resource['title']]);
        } 
        if ($editTeam)
        {
        ?>

        <?=snippet('show-appreciations', ['contentType'=>'Commons Resource', 'contentId'=>$resource['id']]) ?>
        <?=snippet('show-comments', ['contentType'=>'Commons Resource', 'contentId'=>$resource['id']]) ?>
        <?php
        }
        else
        {
?>
        <?=snippet('show-appreciation-button', ['contentType'=>'Commons Resource', 'contentId'=>$resource['id']]) ?>
        <?=snippet('show-comment-box', ['contentType'=>'Commons Resource',  'contentId'=>$resource['id']]) ?>

    <?php
        }
?>
    </div>
   <?php 
    }
}
else
{
?>
    <div class="alert alert-info" role="alert"><?=t("There are currently no resources for this team")?>.</div>
    <?php        
    }
?>
