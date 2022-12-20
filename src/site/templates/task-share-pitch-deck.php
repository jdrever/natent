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
    <input type="hidden" id="collabType" name="collabType" value="Business">
        <label for="form-check"><?=t('Upload your pitch video to your YouTube channel and share the link here','Upload your pitch video to your YouTube channel and share the link here')?>:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="https-addon">https://</span>
            </div>
            <input class="form-control" type="text" id="pitchVideoUrl" name="pitchVideoUrl" aria-describedby="https-addon" value="<?=$team['pitch_video_url']?>">
        </div> 
        
        <?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR PITCH VIDEO','SHARE YOUR PITCH VIDEO')]) ?>
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
