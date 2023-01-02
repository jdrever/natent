<?php snippet('header') ?>
<div class="p-2"
  style="background-image: url('/assets/images/hero-image.jpg'); background-repeat: no-repeat; background-size:cover; height: 300px; ">
  <div class="container mt-lg-5 text-start">
    <div class="shrinkwrap text-start text-white">
      <h1>
        <span><?=$page->heroHeader()?></span>
      </h1>
      <h2>
        <span><?=$page->heroContent()?></span>
      </h2>
    </div>
  </div>
</div>
<div class="container my-4" style="background-color:#f9f8c8;">
  <?php snippet('show-blocks')?>
  <div class="container mx-auto" style="width:60%;" >
    <h3 class="text-center fw-bold mt-4"><?=$page->getStartedHeader()?></h3>
    <p class="d-flex flex-row justify-content-center mb-3">
<?php if ($forTeachers) : ?>
      <a href="<?=$forTeachers->url()?>" class="btn btn-primary flex-fill me-2"><?=$forTeachers->title()?></a>
<?php endif;
if ($forStudents) : ?>
      <a href="<?=$forStudents->url()?>" class="btn btn-secondary flex-fill ms-2"><?=$forStudents->title()?></a>
<?php endif ?>
    </p>
  </div>
</div>

<?php snippet('footer') ?>