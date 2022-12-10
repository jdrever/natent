<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<style>
  figcaption.figure-caption {
    font-size: 1.2em;
  }
</style>
<div class="container mt-2">
  <div class="row">
    <div class="col-sm-4">
<?php snippet('show-phases') ?>
    </div>
    <div class="col-sm-8">
      <h2>Collaboration Points</h2>
      <p class="h1">
        <i class="bi bi-star"></i> 220
      </p>
      <?php snippet('show-blocks',['fieldName' => 'collaborationContent'])?>
      <?php snippet('team-page/latest-comments')?>
      <br>
      <h2>Have a look around!</h2>
      <p>You can always get back to your current Phase by clicking on the RESUME YOUR LEARNING button</p>
      <h3>
        <i class="bi bi-person-heart"></i>TEAM PAGE
      </h3>
      <p>View how your team is getting on</p>
      <h3>
        <i class="bi bi-search-heart"></i>OTHER TEAMS
      </h3>
      <p>Browse other teams pages to get ideas and appreciate their work</p>
      <h3>
        <i class="bi bi-cc-circle-fill"></i>CREATIVE COMMONS
      </h3>
      <p>Find useful resources</p>
    </div>
  </div>
</div>
<?php snippet('footer') ?>