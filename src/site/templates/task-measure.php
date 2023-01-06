<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>
<?php snippet('check-access') ?>

<div class="container bg-light p-3">
<?php if (isset($team['area'])) 
{
?>
  <form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">
        <input type="hidden" id="collabType" name="collabType" value="Measure">
        <label for="recommendations" class="m-1"><?=t('Describe how/if your final Design Solution has addressed the Context and Needs you identified, and which Nature\'s Unifying Patterns have helped you','Describe how/if your final Design Solution has addressed the Context and Needs you identified, and which Nature\'s Unifying Patterns have helped you')?>:</label>
        <textarea class="form-control m-1" aria-label="With textarea" rows="8" id="recommendations"
        name="recommendations"><?=str_replace("<br>","\r\n", $team['recommendations'])?></textarea>
        <?php snippet('add-to-commons-form') ?> 
        <?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR RECOMMENDATIONS','SHARE YOUR RECOMMENDATIONS')]) ?>
    </form>

    <?php
}
else
{
 ?> 

<div class="alert alert-danger" role="alert"><?=t("You need to select your challenge before you complete this Task")?></div> 

<?php
}
?>

</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
