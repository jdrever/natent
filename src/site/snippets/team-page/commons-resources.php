<h3><?=t("Commons Resources shared by")?> <?=$viewedTeam['name']?></h3>
<?php 
use carefulcollab\helpers as cchelpers;

$phaseTitle="";
$collaborationPointType="";
$resources = cchelpers\DataHelper::getResourcesFromCommonsByTeamId($viewedTeam['id'], !$editTeam);

if ($resources)
{
    foreach ($resources as $resource)
    {
        $nextPhaseTitle=$resource['phase_title']; 
        $phasePage = $languagePage->index()->filterBy('phase', strtolower($nextPhaseTitle))->first();       
        if (!($phaseTitle==$nextPhaseTitle))
        {
?>
    <h4><?=$phasePage->title() ?></h4>
    <?php
        }
        $phaseTitle=$resource['phase_title'];
        
        $nextCollaborationPointType=$resource['collaboration_point_type'];
        $collaborationPoint=$languagePage->index()->filterBy('template', $nextCollaborationPointType)->first(); 
        if (isset($collaborationPoint)&&!($collaborationPointType==$nextCollaborationPointType))
        {
                $nextCollaborationPointName=$collaborationPoint->title();
?>
    <h5><?=$nextCollaborationPointName ?></h5>
<?php
            $collaborationPointType=$resource['collaboration_point_type'];
        }
    ?>
    <div class="bg-light border border-primary rounded-3 m-2 p-2">
        <h2><i class="bi bi-file-richtext"></i><?=$resource['title'] ?></h2>

        <?= snippet('show-translatable-content', [ 'content'=>$resource['description']]) ?>
        
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
