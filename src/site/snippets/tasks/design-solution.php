<?php if ($teamArea)
{
?>

<div class="container bg-light p-3">
  <form class="form-inline" method="post" action="<?= $page->url() ?>"
    enctype="multipart/form-data">
    <input type="hidden" id="collabType" name="collabType" value="Create">
    <?php if ((isset($teamDesignFile))&&!empty($teamDesignFile))
    {
    ?>
        <p><b><?=t('Your team has an existing Design Solution. Upload a new file below to replace it','Your team has an existing Design Solution. Upload a new file below to replace it')?>.</b></p>
        <input type="hidden" name="existingDesignIdeaFile" id="existingDesignIdeaFile" value="<?=$teamDesignFile ?>" >
    
        <div class="m-2">
        <?php
            $fileUrl = $teamDesignFile;
            $fileExt = pathinfo($fileUrl, PATHINFO_EXTENSION);
            if(preg_match('(jpg|jpeg|png|gif)', $fileExt) === 1) 
            {
        ?>
        <a target="_blank" href="<?=$fileUrl ?>"><img class="img-fluid" src="<?=$fileUrl ?>" alt="Design Solution" /></a>
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
    ?>
        <label for="designIdea" class="form-label m-1"><?=t('Upload your Design Solution (use an image file, e.g. JPG or PNG)','Upload your Design Solution (use an image file, e.g. JPG or PNG)')?>:</label>
        <input type="file" class="form-control" name="designIdeaFile" id="designIdeaFile">
        <label for="form-check" class="form-label m-1"><?=t('Upload your video presentation to your YouTube channel and share the link here','Upload your video presentation to your YouTube channel and share the link here')?>:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="https-addon">https://</span>
            </div>
            <input class="form-control" type="text" id="designIdeaUrl" name="designIdeaUrl" aria-describedby="https-addon" value="<?=$teamDesignUrl ?>">
        </div>
        <?php snippet('add-to-commons-form') ?> 
        <?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR DESIGN SOLUTION','SHARE YOUR DESIGN SOLUTION')]) ?>
    </form>
</div>
    <?php
}
else
{
 ?> 

<div class="alert alert-danger" role="alert"><?=t("You need to select your challenge before you complete this Task")?></div> 

<?php
}
?>

<br>

