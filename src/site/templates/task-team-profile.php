<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>
<?php snippet('check-access') ?>

<div class="container bg-light p-3">
  <form class="form-inline" method="post" action="<?= $page->url() ?>"
    enctype="multipart/form-data">
    <input type="hidden" id="collabType" name="collabType" value="Profile">
    <label for="school-info" class="m-1"><?= t('Tell us about your Team','Tell us about your Team') ?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="description" name="description" rows="8"
      required><?=$team['description']?></textarea>
    <label for="form-check"><?= t('Tell us what Skillsets your team have','Tell us what Skillsets your team have') ?>:</label>
    <div class="container">
    <?php

foreach ($skills as $skill)
{
    $skillName=$skill['name'];
?>
            <div class="row">
              <div class="col border border-secondary bg-light p-2 m-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="<?=$skillName?>" name="skills[]" id="skills"  <?php if (strpos($team['skills'],$skillName)!== false) { echo ("checked"); } ?> >
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
    <?php snippet('add-to-commons-form') ?> 
    <?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR PROFILE','SHARE YOUR PROFILE')]) ?>
  </form>
</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
