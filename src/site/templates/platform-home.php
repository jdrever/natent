<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<style>
  figcaption.figure-caption {
    font-size: 1.2em;
  }
</style>
<?php $phasesCol=$userLoggedIn ? 6 : 12 ?>
<div class="container mt-2">
  <div class="row" style="background-color:lemonchiffon;">
    <div class="col-sm-12">
      <?php snippet('show-phases') ?>
    </div>
  </div>
  <?php if ($userLoggedIn) : ?>
  <div class="row" style="background-color:#ECE8DD;">
    <div class="col-sm-6">
      <div class="container p-2">
        <h2><?=t('Collaboration Points','Collaboration Points')?></h2>
        <p class="h1">
          <i class="bi bi-star"></i> <?=$team['points']?>
        </p>
        <p>Gain collaboration points by:</p>
        <ul>
          <li>completing the phases</li>
          <li>sharing in the Commons</li>
          <li>appreciating and commenting on other Teams</li>
        </ul>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="container mt-2">
        <?php snippet('show-blocks',['fieldName' => 'collaborationContent'])?>
        <?php snippet('team-page/latest-comments')?>
      </div>
      </div>   
  </div>
  <div class="row" style="background-color:#CEEDC7" >
    <div class="col-sm-6">
      <div class="container p-2 mt-2">
        <h2><?=$page->lookAroundHeader()?></h2>
        <p><?=$page->lookAroundContent()->kt()?></p>
        <a href="<?=$teamPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-person-heart"></i>
          <?=$teamPage->title()?></a>
        <p><?=$page->teamPageContent()->kt()?></p>
        <a href="<?=$otherTeamsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-search-heart"></i>
          <?=$otherTeamsPage->title()?></a>
        <p><?=$page->otherTeamsPageContent()->kt()?></p>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="container p-2 mt-2" style="background-color:#CEEDC7" ;>
        <h2>Resources</h2>
        <a href="<?=$commonsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-cc-circle-fill"></i>
          <?=$commonsPage->title()?></a>
        <p><?=$page->commonsPageContent()->kt()?></p>
        <a href="<?=$nupsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-globe-europe-africa"></i>
          <?=$nupsPage->title()?></a>
        <p><?=$page->nupsPageContent()->kt()?></p>
        <a href="<?=$glossaryPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-list-columns-reverse"></i>
          <?=$glossaryPage->title()?></a>
        <p><?=$page->glossaryPageContent()->kt()?></p>
      </div>
    </div>
    <?php endif ?>
  </div>
</div>
<?php snippet('footer') ?>