<div class="container bg-light p-3">  
<?php if (isset($teamArea)) 
{
?>
<form class="form-inline" method="post" enctype="multipart/form-data">
    <label class="m-1"><?=t('Enter your Research Questions below','Enter your Research Questions below')?></label>

    <?php
    for ($x = 1; $x <= 6; $x++) 
    {
        $functionNumber = "";
        $biologisedQuestionName = "";

        if (isset($teamFunctions[$x-1]))
        {
            $function = $teamFunctions[$x-1];
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
            <input type="text" class="form-control bg-info text-white" name="biologized<?=$x?>" id="biologized<?=$x?>" placeholder="<?=$page->researchQuestionLabel()?> <?=$x?>" aria-label="<?=$page->researchQuestionLabel()?> <?=$x?>" value="<?=$biologisedQuestionName?>" <?=($userLoggedIn) ? '' : 'readonly'?>>
            <label class="text-white" for="biologized<?=$x?>"><?=t('Research Question','Research Question')?> <?=$x?></label>
        </div>
        <?php if ($biologisedQuestionName) : ?>
            <input type="checkbox" name="remove<?=$x?>" id="remove<?=$x?>"  value="y"><label for="remove<?=$x?>" class="form-text">&nbsp;<?=t('Remove this Research Question and any associated Strategies and Principles','Remove this Research Question and any associated Strategies and Principles')?></label>
        <?php endif ?>
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