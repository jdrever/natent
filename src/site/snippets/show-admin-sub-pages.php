<?php

$teamPage=$page->children()->find('/platform/admin/teams');
$contentPage=$page->children()->find('/platform/admin/content');
?>
<div class="container px-4">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
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
  </div>
</div>