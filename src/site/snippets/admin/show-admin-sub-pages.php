<?php

$teamPage=$page->children()->find('/platform/admin/teams');
$contentPage=$page->children()->find('/platform/admin/content');
$locationsPage=$page->children()->find('/platform/admin/locations');
$teachersPage=$page->children()->find('/platform/admin/teachers');
$challengesPage=$page->children()->find('/platform/admin/challenges');
$kirbyIdsPage=$page->children()->find('/platform/admin/kirby-ids');

?>
<div class="container px-4">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
  <?php if ($userLoggedIn&&($userRole=="ADMIN"||$userRole=="GLOBAL")) : ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $locationsPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $locationsPage->pageTitle()->isEmpty() ? $locationsPage->title()->html() : $locationsPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $teachersPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $teachersPage->pageTitle()->isEmpty() ? $teachersPage->title()->html() : $teachersPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $challengesPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $challengesPage->pageTitle()->isEmpty() ? $challengesPage->title()->html() : $challengesPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <?php endif ?> 
    <?php if ($userLoggedIn&&($userRole=="TEACHER"||$userRole=="ADMIN"||$userRole=="GLOBAL")) : ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $teamPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $teamPage->pageTitle()->isEmpty() ? $teamPage->title()->html() : $teamPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $contentPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $contentPage->pageTitle()->isEmpty() ? $contentPage->title()->html() : $contentPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <?php endif ?>
    <?php if ($userLoggedIn&&$userRole=="GLOBAL") : ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $kirbyIdsPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $kirbyIdsPage->pageTitle()->isEmpty() ? $kirbyIdsPage->title()->html() : $kirbyIdsPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <?php endif ?>
  </div>
</div>