<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<style>
  figcaption.figure-caption 
  {
    font-size: 1.2em;
  }
</style>
<?php $phasesCol=$userLoggedIn ? 4 : 12 ?>
<div class="container mt-2">
  <div class="row">
    <div class="col-sm-<?=$phasesCol?>">
<?php snippet('show-phases') ?>
    </div>
<?php if ($userLoggedIn) : ?>
    <div class="col-sm-8">
      <h2><?=t('Collaboration Points','Collaboration Points')?></h2>
      <p class="h1">
        <i class="bi bi-star"></i> <?=$team['points']?>
      </p>
      <?php snippet('show-blocks',['fieldName' => 'collaborationContent'])?>
      <?php snippet('team-page/latest-comments')?>
      <br>
      <h2><?=$page->lookAroundHeader()?></h2>
      <p><?=$page->lookAroundContent()->kt()?></p>
      <h3>
        <a href="<?=$teamPage->url()?>"><i class="bi bi-person-heart"></i><?=$teamPage->title()?></a>
      </h3>
      <p><?=$page->teamPageContent()->kt()?></p>
      <h3>
        <a href="<?=$otherTeamsPage->url()?>"><i class="bi bi-search-heart"></i><?=$otherTeamsPage->title()?></a>
      </h3>
      <p><?=$page->otherTeamsPageContent()->kt()?></p>
      <h3>
      <a href="<?=$commonsPage->url()?>"><i class="bi bi-cc-circle-fill"></i><?=$commonsPage->title()?></a>
      </h3>
      <p><?=$page->commonsPageContent()->kt()?></p>
    </div>
    <?php endif ?>
  </div>
</div>
<?php snippet('footer') ?>