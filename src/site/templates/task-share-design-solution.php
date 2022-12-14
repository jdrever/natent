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
  <form class="form-inline" method="post" action="<?= $page->url() ?>"
    enctype="multipart/form-data">

    <?php if ((isset($team['design_idea_file']))&&!empty($team['design_idea_file']))
    {
    ?>
        <p><b><?=$page->existingSolutionLabel()?>.</b></p>
        <input type="hidden" name="existingDesignIdeaFile" id="existingDesignIdeaFile" value="<?=$team["design_idea_file"] ?>" >
    
        <div>
        <?php
            $fileUrl = $team['design_idea_file'];
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
        <a target="_blank" href="<?=$fileUrl ?>" class="btn btn-outline-primary btn-outline btn-sm">DOWNLOAD</a>
        <?php
            } 
        ?>
        </div>
    <?php
    }
    ?>
        <label for="designIdea" class="m-1"><?=$page->uploadSolutionLabel()?>:</label>
        <input type="file" name="designIdeaFile" id="designIdeaFile">
        <label for="form-check"><?=$page->uploadVideoPresentationLabel()?>:</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="https-addon">https://</span>
            </div>
            <input class="form-control" type="text" id="designIdeaUrl" name="designIdeaUrl" aria-describedby="https-addon" value="<?=$team['design_idea_url'] ?>">
        </div>
        
        <?php snippet('guide-navigation', ['taskButton' =>$page->shareSolutionButton()]) ?>
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

<br>

</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>