<div class="container bg-light p-3">  
<?php if ($teamArea) 
{
    if (!empty($teamFunctions))
    {
?>

<form class="form-inline" method="post" action="<?=$page->url()?>" enctype="multipart/form-data">
    <?php 
        $functionNumbers = "";
        foreach ($teamFunctions as $function) 
        {
          if (!empty($function['biologized_question']))
          {
            $functionNumber = $function['function_number'];
            $functionNumbers .= $functionNumber . ',';
            $functionStrategies = $teamStrategies[$functionNumber];
    ?>
    <div class="container border bg-light p-2 m-2">
        <div class="row bg-info text-white p-2">
            <div class="col">
            <?=t('RESEARCH QUESTION','RESEARCH QUESTION') ?>: <?=$function['biologized_question'] ?> <i class="bi bi-arrow-right-circle-fill"></i></div>
        </div>
        <div class="row m-1">
            <div class="col"><label class="form-label"><?=t('Enter up to six Natural Strategies and Design Principles for your Research Question','Enter up to six Natural Strategies and Design Principles for your Research Question')?>:</label></div>
        </div>
        <?php
        for ($x = 1; $x <= 6; $x++) 
        {
            if ($x==4)
            {
        ?>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <?=t('Add More Strategies / Principles','Add More Strategies / Principles')?></button>
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
                    <textarea class="form-control" placeholder="<?=t('Natural Strategy','Natural Strategy')?> <?=$x?>" aria-label="<?=t('Natural Strategy','Natural Strategy')?> <?=$x?>" rows="8" name="<?=$strategyId?>" id="<?=$strategyId?>" <?=($userLoggedIn) ? '' : 'readonly'?>><?=$strategyName?></textarea>
                    <label for="<?=$strategyId?>"><?=t('Natural Strategy','Natural Strategy')?> <?=$x?></label>
                </div>
                <i class="bi bi-arrow-right-circle-fill"></i>
                <div class="form-floating">
                    <input type="text" class="form-control" name="<?=$principleId?>" id="<?=$principleId?>"  placeholder="<?=t('Design Principle','Design Principle')?> <?=$x?>" aria-label="<?=t('Design Principle','Design Principle')?> <?=$x?>" value="<?=$designPrincipleName?>" <?=($userLoggedIn) ? '' : 'readonly'?>>
                    <label for="<?=$principleId?>"><?=t('Design Principle','Design Principle')?> <?=$x?></label>
                </div>

                <?php if ($strategyName) : ?>
            <input type="checkbox" name="remove<?=$strategyId?>" id="remove<?=$x?>"  value="y"><label for="remove<?=$x?>" class="form-text">&nbsp;<?=t('Remove this Natural Strategy/Design Principle','Remove this Natural Strategy/Design Principle')?></label>
        <?php endif ?>
            </div>
        </div>
        <?php
          }
        }    
        ?>
        </div>
    </div>
    <?php
        }    
    ?>
    <input type="hidden" id="functionNumbers" name="functionNumbers" value="<?=$functionNumbers ?>" />

    <?php snippet('add-to-commons-form') ?> 
    <?php snippet('guide-navigation', ['taskButton'=>t('SHARE YOUR STRATEGIES AND PRINCIPLES','SHARE YOUR STRATEGIES AND PRINCIPLES')]) ?>
</form>

<?php
    }
    else
    {
 ?> 
<div class="alert alert-danger" role="alert"><?=t("You need to enter your Research Questions before you enter your strategies","You need to enter your Research Questions before you enter your strategies")?></div>  

<?php
}
}
else
{
?> 

<div class="alert alert-danger" role="alert"><?=t("You need to select your challenge before you complete this Task","You need to select your challenge before you complete this Task")?></div> 

<?php
}
?>

<br>

</div>