<div class="container bg-light p-3">
<?php if (isset($teamArea)) 
{
  if ((isset($teamPitchVideoUrl))&&!empty($teamPitchVideoUrl)) : ?>
    <p><b><?=t('Your team has an existing pitch video. Change the link below to replace it','Your team has an existing pitch video. Upload a link below to replace it')?>.</b></p>
    <iframe loading="lazy" title="'Pitch Video" width="500" height="281" src="https://www.youtube.com/embed/<?= $teamPitchVideoYouTubeId ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
  <?php endif ?>
  <form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">
    <input type="hidden" id="collabType" name="collabType" value="Business">
        <label for="form-check" class="form-label"><?=t('Upload your pitch video to your YouTube channel and share the link here','Upload your pitch video to your YouTube channel and share the link here')?>:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="https-addon">https://</span>
            </div>
            <input class="form-control" type="text" id="pitchVideoUrl" name="pitchVideoUrl" aria-describedby="https-addon" value="<?=$teamPitchVideoUrl?>" <?=($userLoggedIn) ? '' : 'readonly'?>>
        </div> 
        <?php snippet('add-to-commons-form') ?> 
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