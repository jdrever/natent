<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<style>
  figcaption.figure-caption {
    font-size: 1.2em;
  }
</style>
<div class="container mt-2 bg-light">
<?php if (!$userLoggedIn)  : ?>
  <div class="row">
    <div class="col-sm-12 p-2">
      <div class="alert alert-info p-2" role="alert">
        <h2><i class="bi bi-info-square-fill"></i> <?=t('Login or Register to access collaboration features','Login or Register to access collaboration features')?></h2>
        <p><?=t('Everyone can explore the Natural Entrepreneurs Learning Journey','Everyone can explore the Natural Entrepreurs Learning Journey but to complete tasks and collaborate with other teams, you will need to register your school with the
          project')?>.</p>
        <p><a class="btn btn-primary" href="<?=$registerPage->url()?>"><?=$registerPage->pageTitle()->isNotEmpty() ? $registerPage->pageTitle() : $registerPage->title()?></a> <?=t('Or if you already have a username and password, then', 'or if you already have a username and password, then')?> 
          <a class="btn btn-primary" href="<?=$loginPage->url()?>"><?=$loginPage->pageTitle()->isNotEmpty() ? $loginPage->pageTitle() : $loginPage->title()?></a></p>
      </div>
    </div>
  </div>
  <?php endif ?> 

  <div class="row pb-4">
    <div class="col-sm-12">
      <?php snippet('show-phases') ?>
    </div>
  </div>
    <?php if ($userLoggedIn) : ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="container p-2">
            <h2><?=t('Collaboration Points','Collaboration Points')?></h2>

            <p class="h1">
              <i class="bi bi-star"></i> <?=$team['points']?>
            </p>
            <?php snippet('show-blocks',['fieldName' => 'collaborationContent'])?>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="container mt-2">
          <?php snippet('admin/moderation-notification')?>
            <?php snippet('team-page/latest-comments')?>
          </div>
        </div>
      </div>
      <?php endif ?>

        
  
  <div class="row">
    <div class="col-sm-6">
      <div class="container p-2 mt-2">
        <h2><?=$page->lookAroundHeader()?></h2>
        <p><?=$page->lookAroundContent()->kt()?></p>
        <?php if ($userLoggedIn) : ?>
        <a href="<?=$teamPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-person-heart"></i>
          <?=$teamPage->pageTitle()->isNotEmpty() ? $teamPage->pageTitle() : $teamPage->title()?></a>
        <p><?=$page->teamPageContent()->kt()?></p>
        <a href="<?=$otherTeamsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-search-heart"></i>
          <?=$otherTeamsPage->pageTitle()->isNotEmpty() ? $otherTeamsPage->pageTitle() : $otherTeamsPage->title()?></a>
        <p><?=$page->otherTeamsPageContent()->kt()?></p>
        <?php endif ?>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="container p-2 mt-2">
        <h2><?=t('Resources','Resources')?></h2>
        <?php if ($userLoggedIn) : ?>
        <a href="<?=$commonsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-cc-circle-fill"></i>
          <?=$commonsPage->pageTitle()->isNotEmpty() ? $commonsPage->pageTitle() : $commonsPage->title()?></a>
        <p><?=$page->commonsPageContent()->kt()?></p>
        <?php endif ?>
        <?php if (isset($exampleTeam)) : ?>
            <p><a href="<?= $exampleTeamPage->url() ?>" class="btn btn-outline-primary"><i class="bi bi-person-heart"></i><?=$exampleTeamPage->pageTitle()->isNotEmpty() ? $exampleTeamPage->pageTitle() : $exampleTeamPage->title() ?></a></p>      
        <?php endif ?>
        <p><a href="<?=$nupsPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-globe-europe-africa"></i>
          <?=$nupsPage->pageTitle()->isNotEmpty() ? $nupsPage->pageTitle() : $nupsPage->title()?></a></p>
        <p><a href="<?=$glossaryPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-list-columns-reverse"></i>
          <?=$glossaryPage->pageTitle()->isNotEmpty() ? $glossaryPage->pageTitle() : $glossaryPage->title()?></a></p>
      </div>
    </div>
  </div>
</div>
<?php snippet('footer') ?>