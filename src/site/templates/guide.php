<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<div class="container">
  <div class="row">
    <div class="col-12" d-none d-lg-block>
      <h1 class="fw-bold"><?=$page->title()?></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <?php if($image = $page->image()): ?>
      <div>
        <img class="img-fluid rounded" src="<?= $image->url() ?>" alt="" width="250" height="250">
        <?php endif ?>
        <div class="progress mt-1 mb-4" style="height:30px;">
          <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50"
            aria-valuemin="0" aria-valuemax="100">
            50%
          </div>
        </div>
      </div>
      <div class="col">
        <p class="has-medium-font-size lh-sm"><strong>
            <?=$page->description()?></p>
        </strong>
        </p>
        <?php snippet('show-blocks') ?>
        <?php snippet('guide-navigation') ?>
        <?php snippet('show-guide-contents') ?>
        </main>
      </div>
    </div>
  </div>
</div>
<?php snippet('footer') ?>