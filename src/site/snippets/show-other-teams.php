<?php
 use carefulcollab\helpers as helpers;
 ?>
<div class="container my-4">
  <h1 class="pb-2 border-bottom"><i class="bi bi-search-heart"></i> Other Teams </h1>
  <div class="btn-toolbar" role="group" aria-label="<?=$page->filterTopicsLabel()?>">
    <p class="p-1 m-0"><?=$page->filterTopicsLabel()?></p>
    <p><a href="<?=$page->url() ?>?areaId=All"
        class="btn btn-sm btn-<?=$showAsOutlineAllAreas ?>primary"><?=$page->allTopicsLink()?></a>
      <?php
    foreach ($areas as $area)
    {
        $areaName=$area['name'];
        $areaId=$area['id'];
        if (($areaFilter==$areaId))
        {
            $showAsOutline="";
        }
        else $showAsOutline="outline-";
?>

      <a href="<?=$page->url() ?>?areaId=<?=$areaId ?>"
        class="btn btn-sm btn-<?=$showAsOutline ?>primary"><?=t($areaName, $areaName)?></a>
      <?php
}
?>
    </p>
  </div>
  <div class="btn-toolbar" role="group" aria-label="<?=$page->filterCountriesLabel()?>">
    <p class="p-1 m-0"><?=$page->filterCountriesLabel()?></p>
    <p><a href="<?=$page->url() ?>?countryId=All"
        class="btn btn-sm btn-<?=$showAsOutlineAllCountries ?>primary"><?=$page->allCountriesLink()?></a>
      <?php
    foreach ($countries as $eachCountry)
    {
        $countryName=$eachCountry['name'];
        $countryId=$eachCountry['id'];
        if (($countryFilter==$countryId))
        {
            $showAsOutline="";
        }
        else $showAsOutline="outline-";
?>

      <a href="<?=$page->url() ?>?countryId=<?=$countryId ?>"
        class="btn btn-sm btn-<?=$showAsOutline ?>primary"><?=t($countryName, $countryName)?></a>
      <?php
}
?>
  </div>
  <div class="btn-toolbar" role="group" aria-label="<?=$page->filterSkillsetsLabel()?>">
    <p class="p-1 m-0"><?=$page->filterSkillsetsLabel()?></p>
    <p><a href="<?=$page->url() ?>?skillsetName=All"
        class="btn btn-sm btn-<?=$showAsOutlineAllSkillsets ?>primary"><?=$page->allSkillsetsLink()?></a>
      <?php
    foreach ($skillsets as $skillset)
    {
        $skillsetName=$skillset['name'];
        if (($skillsetFilter==$skillsetName))
        {
            $showAsOutline="";
        }
        else $showAsOutline="outline-";
?>

      <a href="<?=$page->url() ?>?skillsetName=<?=$skillsetName ?>"
        class="btn btn-sm btn-<?=$showAsOutline ?>primary"><?=t($skillsetName, $skillsetName)?></a>
      <?php
}
?>
    </p>
  </div>
  <table class="table table-striped card-1">
    <tr>
      <thead>
        <th><?=t("Team Name")?></th>
        <th><?=t("Topic")?></th>
        <th><?=t("Challenge")?></th>
        <th><?=t("Points")?></th>
        <th><?=t("Progress")?></th>
      </thead>
    </tr>
    <?php 

  
$otherTeamPage=$site->find('platfomr/other-team-page');


foreach($otherTeams as $otherTeam)
{
    //$phases = helpers\DataHelper::getPhasesByCountryId($otherTeam['country_id']);
?>

    <tr>
      <td><a href="<?=$otherTeamPage->url() . '/?teamId=' . $otherTeam['id']?>"><?=$otherTeam['name']?></a>
      </td>
      <td><?=$otherTeam['area']?></td>
      <td><?=$otherTeam['challenge']?></td>
      <td><?=$otherTeam['points']?></td>
      <td colspan=4>
        <div class="container-fluid">
          <div class="row p-3">
            <?php
foreach ($phases as $phase) :
  $pagesInPhase=$site->index()->filterBy('phase', strtolower($phase->title()));
  if ($pagesInPhase):
    $countryPhase=$pagesInPhase->filterBy('countries', '*=', str_replace(" ","-",strtolower($country)))->first();
    if ($countryPhase) :
      $phaseTitle=$countryPhase->title();
      $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($otherTeam['id'],$phase->title());
      $phaseCompletion=$phaseCompletionInfo['percent_complete'];
?>
          <div class="col">
            <h5><?=$phaseTitle ?></h5>
            <div class="progress">
              <div class="progress-bar bg-info" role="progressbar" style="width: <?= $phaseCompletion ?>%;"
                aria-valuenow="<?= $phaseCompletion ?>" aria-valuemin="0" aria-valuemax="100">
                <?= $phaseCompletion ?>%</div>
            </div>
          </div>
          <?php
    endif;
  endif;
endforeach;
?>
          </div>
      </td>
    </tr>

    <?php
}
?>
  </table>

</div>