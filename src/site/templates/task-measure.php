<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<div class="container bg-light p-3">
<?php if (isset($team['area'])) 
{
?>
  <form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">
        <input type="hidden" name="point" id="point" value="">
        
        <label for="recommendations" class="m-1"><?=$page->measureDescriptionLabel()?>:</label>
        <textarea class="form-control m-1" aria-label="With textarea" rows="8" id="recommendations"
        name="recommendations"><?=str_replace("<br>","\r\n", $team['recommendations'])?></textarea>

        <?php snippet('guide-navigation', ['taskButton' =>$page->shareRecommendationsButton()]) ?>
    </form>

    <?php
}
else
{
 ?> 

<div class="alert alert-danger" role="alert"><?=$page->needToSelectChallengeLabel()?></div> 

<?php
}
?>

</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
