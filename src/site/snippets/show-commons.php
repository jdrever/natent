<?php
use carefulcollab\helpers as helpers;
?>
  <div class="btn-toolbar" role="group" aria-label="filterPhasesLabel()">
        <p class="p-1 m-1"><?=$page->filterPhasesLabel()?></p>
        <a href="<?=$page->url()?>?phaseType=General"
            class="btn btn-<?=$showAsOutlineGeneralPhase ?>primary"><?=$page->generalLink()?></a>
        <a href="<?=$page->url()?>?phaseType=All"
            class="btn btn-<?=$showAsOutlineAllPhases ?>primary"><?=$page->allPhasesLink()?></a>
        <?php
foreach ($phases as $phase)
{
    $phaseTitle=$phase->title();
    $phaseType=$phase->phase();
    if (($phaseTypeFilter==$phaseType))
    {
        $showAsOutline="";
        $phaseTypeFilterSet=true;
        $selectedPhase=$phase;
    }
    else $showAsOutline="outline-";

?>

        <a href="<?=$page->url()?>?phaseType=<?=$phaseType ?>"
            class="btn btn-<?=$showAsOutline ?>primary"><?=$phaseTitle?></a>
        <?php
}
?>
    </div>
    <?php

if ($phaseTypeFilterSet&&!($phaseTypeFilter==="General")&&$selectedPhase)
{
  $collaborationPoints=$selectedPhase->index()->filterBy('template','^=', 'task');
    if ($collaborationPointFilter==="All" or empty($collaborationPointFilter))
    {
        $showAsOutlineAllPoints="";
    }
    else 
        $showAsOutlineAllPoints="outline-";
?>
    <div class="btn-toolbar btn-group-sm p-2" role="group" aria-label="<?=$page->filterCollaborationPointsLabel()?>">
        <p class="p-1 m-1"><?=$page->filterCollaborationPointsLabel()?></p>
        <a href="<?=$page->url()?>?phaseType=<?=$phaseTypeFilter ?>&collaborationPointType=All"
            class="btn btn-<?=$showAsOutlineAllPoints ?>primary m-1"><?=$page->allCollaborationPointsLink()?></a>
        <?php
    foreach ($collaborationPoints as $collaborationPoint)
    {
        $collaborationPointName=$collaborationPoint->title();
        $collaborationPointType=$collaborationPoint->template();

        if (!($collaborationPointFilter==$collaborationPointType))
        {
            $showAsOutline="outline-";
            $pcollaborationTypeFilterSet=true;
        }
        else $showAsOutline="";

?>

        <a href="<?=$page->url()?>?phaseType=<?=$phaseTypeFilter ?>&collaborationPointType=<?=$collaborationPointType?>"
            class="btn btn-<?=$showAsOutline ?>primary m-1"><?=$collaborationPointName?></a>
        <?php
    }
?>
    </div>
    <?php
}
$countries = helpers\DataHelper::getCountries();
?>
    <div class="btn-toolbar" role="group" aria-label="<?=$page->filterCountriesLabel()?>">
        <p class="p-1 m-1"><?=$page->filterCountriesLabel()?></p>
        <p><a href="<?=$page->url()?>?countryId=All"
            class="btn btn-<?=$showAsOutlineAllCountries ?>primary m-1"><?=$page->allCountriesLink()?></a>
                <?php
    foreach ($countries as $country)
    {
        $countryName=$country['name'];
        $countryId=$country['id'];
        if (($countryFilter==$countryId))
        {
            $showAsOutline="";
        }
        else $showAsOutline="outline-";
?>

        <a href="<?=$page->url()?>?countryId=<?=$countryId ?>"
            class="btn btn-<?=$showAsOutline ?>primary"><?=t($countryName,$countryName)?></a>
        <?php
    }
?>
    </div>


    <div class="btn-toolbar btn-group-sm p-2" role="group" aria-label="<?=$page->filterRecommendationsLabel()?>">
    <p class="p-1 m-0"><?=$page->filterRecommendationLabel()?>: </p>
        <a href="<?=$page->url()?>?resources=All"
            class="btn btn-<?=$showAllResourcesAsOutline ?>primary m-1"><?=$page->allResourcesLink()?></a>
        <a href="<?=$page->url()?>?resources=Recommended"
            class="btn btn-<?=$showRecommendedResourcesAsOutline ?>primary m-1"><?=$page->recommendedResourcesLink()?></a>
    </div>
<?php        

$phaseTitle="";
$collaborationPointName="";


if ($resources)
{
    foreach ($resources as $resource)
    {
        $nextPhaseTitle=$resource['phase_title'];        
        if (!($phaseTitle==$nextPhaseTitle))
        {
            $nextPhase=helpers\DataHelper::getPhaseTitle($userId,$nextPhaseTitle);
?>
    <h3><?=isset($nextPhase['phase_title']) ? $nextPhase['phase_title'] : 'Missing phase' ?></h3>
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
    <h4><?=$nextCollaborationPointName ?></h4>
    <?php
                $collaborationPointName=$resource['collaboration_point_name'];
            }
    ?>
    <div class="bg-light border border-primary rounded-3 m-2 p-2">
        <h2><i class="bi bi-file-richtext"></i><?=$resource['title'] ?></h2>
        <?= snippet('show-translatable-content', [ 'content'=>$resource['description']] ) ?>
        <?php 
            $setRecommended=1;
            if (isset($resource['recommended']))
            {
                if ($resource['recommended']==1)
                {
                    $setRecommended=0;
                }
            }
            if (!empty($resource['url'])) 
            { 
                $resourceUrl=str_replace("https://","",$resource['url']);
        ?>
        <p><b><?=t("Website Link", "Website Link")?>: </b> <a href="https://<?=$resourceUrl ?>" target="_blank"><?=$resourceUrl?></a></p>
        <?php 
            }
            if (!empty($resource['file_upload_url'])) 
            { 
         ?>       
        <p><b><?=t("Uploaded File","Uploaded File")?>: </b><p>
        <?= snippet('show-file', [ 'fileUrl'=>$resource['file_upload_url'],'altText'=>$resource['title']]);?>
        <?php  
        } ?>

        <?=snippet('show-appreciation-button', ['contentType'=>'Commons Resource', 'contentId'=>$resource['id']]) ?>
        <?=snippet('show-comment-box', ['contentType'=>'Commons Resource', 'contentId'=>$resource['id']]) ?>
        <?=snippet('show-recommendation-button', ['resourceId'=>$resource['id'], 'recommend'=>$setRecommended]) ?>
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