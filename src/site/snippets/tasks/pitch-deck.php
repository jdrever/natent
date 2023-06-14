<?php if (isset($teamArea)) 
{
?>
<div class="container bg-light p-3">
<form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">  
<?php
  if ((isset($teamPitchFile))&&!empty($teamPitchFile))
  {
  ?>
      <p><b><?=t('Your team has an existing pitch document. Upload a new file below to replace it','Your team has an existing pitch document. Upload a new file below to replace it')?>.</b></p>
      <input type="hidden" name="existingPitchFile" id="existingPitchFile" value="<?=$teamPitchFile ?>" >
  
      <div class="m-2">
      <?php
          $fileUrl = $teamPitchFile;
          $fileExt = pathinfo($fileUrl, PATHINFO_EXTENSION);
          if(preg_match('(jpg|jpeg|png|gif)', $fileExt) === 1) 
          {
      ?>
      <a target="_blank" href="<?=$fileUrl ?>"><img class="img-fluid" src="<?=$fileUrl ?>" alt="Pitch" /></a>
      <?php
          }
          if ($fileExt=="pdf")
          {
      ?>
      <iframe src="https://docs.google.com/viewer?url=<?=$fileUrl?>&embedded=true" frameborder="0" height="300px" width="100%"></iframe>
      <a target="_blank" href="<?=$fileUrl ?>" class="btn btn-outline-primary btn-outline btn-sm"><?=t('DOWNLOAD','DOWNLOAD')?></a>
      <?php
          } 
      ?>
      </div>
  <?php
  }
  if ((isset($teamPitchVideoUrl))&&!empty($teamPitchVideoUrl)) : ?>
    <p><b><?=t('Your team has an existing pitch video. Change the link below to replace it','Your team has an existing pitch video. Upload a link below to replace it')?>.</b></p>
    <iframe loading="lazy" title="'Pitch Video" width="500" height="281" src="https://www.youtube.com/embed/<?= $teamPitchVideoYouTubeId ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
  <?php endif ?>
   
    <label for="pitchFile" class="form-label m-1"><?=t('Upload your pitch document (use a PDF or image file, e.g. JPG or PNG)','Upload your pitch document (use a PDF or image file, e.g. JPG or PNG)')?>:</label>
        <input type="file" class="form-control" name="pitchFile" id="pitchFile" <?=($userLoggedIn) ? '' : 'disabled'?>>
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