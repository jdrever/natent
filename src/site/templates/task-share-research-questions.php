<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<?php snippet('team-page-link')?>

<div class="container bg-light p-3">
    
<?php if (isset($team['area'])) 
{
?>
<form class="form-inline" method="post" action="<?= $page->url() ?>" enctype="multipart/form-data">
  <input type="hidden" id="collabType" name="collabType" value="Functions">
    <label class="m-1"><?=t('Enter your Research Questions below','Enter your Research Questions below')?></label>

    <?php
    for ($x = 1; $x <= 6; $x++) 
    {
        $functionNumber = "";
        $biologisedQuestionName = "";

        if (isset($functions[$x-1]))
        {
            $function = $functions[$x-1];
            $functionNumber = $function['function_number'];
            $biologisedQuestionName = $function['biologized_question'];
        }
   
        if ($x==4)
        {
    ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExtraQuestions" aria-expanded="false" aria-controls="collapseExtraQuestions">
    <?=t('Add More Research Questions','Add More Research Questions')?> </button>

    <div class="collapse" id="collapseExtraQuestions">

    <?php
        }
    ?>

    <div class="container border bg-light p-2 m-2">
        <input type="hidden"  name="functionNumber<?=$x?>" id="functionNumber<?=$x?>" value="<?=$functionNumber?>">
        <div class="form-floating">
            <input type="text" class="form-control bg-info text-white" name="biologized<?=$x?>" id="biologized<?=$x?>" placeholder="<?=$page->researchQuestionLabel()?> <?=$x?>" aria-label="<?=$page->researchQuestionLabel()?> <?=$x?>" value="<?=$biologisedQuestionName?>">
            <label class="text-white" for="biologized<?=$x?>"><?=t('Research Question','Research Question')?> <?=$x?></label>
        </div>
    </div>

    <?php
    }
    ?>

    </div> 
    <?php snippet('add-to-commons-form') ?> 
<?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR RESEARCH QUESTIONS','SHARE YOUR RESEARCH QUESTIONS')]) ?>
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

<br>

</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>