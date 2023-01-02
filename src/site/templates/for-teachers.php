<?php snippet('header') ?>
<div class="container-fluid bg-dark text-light p-4"
  style="background-image: url('/assets/images/SDGs.png'); background-repeat: no-repeat;background-size:cover; height:250px;">
  <div class="col-lg-8 mx-auto mask mt-0">
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
<div class="container my-4">
<?php snippet ('show-blocks') ?>
<?php snippet('show-sub-pages') ?>
</div>
<?php snippet('footer') ?>