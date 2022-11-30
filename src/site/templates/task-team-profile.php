<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<div class="container bg-light p-3">
  <form class="form-inline" method="post" action="<?= $page->url() ?>"
    enctype="multipart/form-data">
    <label for="school-info" class="m-1"><?= $page->teamLabel() ?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="description" name="description" rows="8"
      required><?=$description?></textarea>
    <label for="form-check"><?= $page->skillsetsLabel() ?>:</label>
    <div class="container">
    <?php

foreach ($skills as $skill)
{
    $skillName=$skill['name'];
?>
            <div class="row">
              <div class="col border border-secondary bg-light p-2 m-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="<?=$skillName?>" name="skills[]" id="skills"  <?php if (strpos($teamSkills,$skillName)!== false) { echo ("checked"); } ?> >
                        <label class="form-check-label" for="skills">
                            <?=t($skillName, $skillName) ?>
                        </label>
                    </div>
                </div>
            </div>
<?php
}
?>    </div>
    <br>
    <?php snippet('guide-navigation', ['taskButton' =>$page->shareProfileButton()]) ?>
  </form>
</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
