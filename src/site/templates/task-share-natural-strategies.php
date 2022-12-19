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
    if (!empty($functions))
    {
?>

<form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">

    <?php 
        $functionNumbers = "";
        foreach ($functions as $function) 
        {
            $functionNumber = $function['function_number'];
            $functionNumbers .= $functionNumber . ',';
            $functionStrategies = $strategies[$functionNumber];
    ?>
    <div class="container border bg-light p-2 m-2">
        <div class="row bg-info p-2">
            <div class="col"><?php if (isset($function['name'])) { ?>
            <?=$page->functionLabel()?>: <?= $function['name'] ?> <i class="bi bi-arrow-right-circle-fill"></i> <?php } ?>
            <?=$page->researchQuestionLabel()?> <?=$function['biologized_question'] ?> <i class="bi bi-arrow-right-circle-fill"></i></div>
        </div>
        <div class="row m-1">
            <div class="col"><label class="form-label"><?=$page->functionDescriptionLabel()?>:</label></div>
        </div>
        <?php
        for ($x = 1; $x <= 6; $x++) 
        {
            if ($x==4)
            {
        ?>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <?=$page->addMoreLabel()?></button>
        <div class="collapse" id="collapseExample">
        <?php
            }

            $strategyId = $function['function_number'] . 'strategy' . $x;
            $strategyName = "";
            $designPrincipleName = "";

            if (isset($functionStrategies[$x-1]))
            {
                $strategy = $functionStrategies[$x-1];
                $strategyName = $strategy['strategy_name']; 
                $designPrincipleName = $strategy['design_principle'];          
            }
            $principleId = $function['function_number'] . 'principle' . $x;
        ?>
        <div class="row m-2 p-2 bg-light border border-4 border-info">
            <div class="col">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="<?=$page->naturalStrategyLabel()?> <?=$x?>" aria-label="<?=$page->naturalStrategyLabel()?> <?=$x?>" rows="8" name="<?=$strategyId?>" id="<?=$strategyId?>"><?=$strategyName?></textarea>
                    <label for="<?=$strategyId?>"><?=$page->naturalStrategyLabel()?> <?=$x?></label>
                </div>
                <i class="bi bi-arrow-right-circle-fill"></i>
                <div class="form-floating">
                    <input type="text" class="form-control" name="<?=$principleId?>" id="<?=$principleId?>"  placeholder="<?=$page->designPrincipleLabel()?> aria-label="<?=$page->designPrincipleLabel()?> value="<?=$designPrincipleName?>">
                    <label for="<?=$principleId?>"><?=$page->designPrincipleLabel()?> <?=$x?></label>
                </div>
            </div>
        </div>
        <?php
        }    
        ?>
        </div>
    </div>
    <?php
        }    
    ?>
    <input type="hidden" id="functionNumbers" name="functionNumbers" value="<?=$functionNumbers ?>" />
    <?php snippet('guide-navigation', ['taskButton' =>$page->shareStrategiesButton()]) ?>
</form>

<?php
    }
    else
    {
 ?> 
<div class="alert alert-danger" role="alert"><?=t("You need to enter your Research Questions before you enter your strategies")?></div>  

<?php
}
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