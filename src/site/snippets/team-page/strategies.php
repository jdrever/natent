<?php
use carefulcollab\helpers as helpers;
?>

<h4><?=t('Research Questions','Research Questions')?></h4>
<?php
$functions = helpers\DataHelper::getFunctionsByTeam($viewedTeam['id'], !$editTeam);

if ($functions) :
foreach ($functions as $function) :
    $researchQuestion=$function['biologized_question'];
    if (!empty($researchQuestion)) :
?>
    <table class="table m-2 p-2 border">
        <tr>
            <th class="bg-info text-white"><?=t("RESEARCH QUESTION", "RESEARCH QUESTION")?>: <?= $researchQuestion ?>
                <?php snippet('show-translatable-content', ['content'=>"RESEARCH QUESTION: " . $researchQuestion, 'showButton'=>!$editTeam,'showContent'=>false]) ?>
            </th>
        </tr>
        <?php

    $strategies = helpers\DataHelper::getNaturalStrategiesByFunctionNumberAndTeamId($viewedTeam['id'], $function['function_number'], !$editTeam);
    foreach ($strategies as $strategy)
    {
        ?>
            <tr class="bg-light">
                <td><i class="bi bi-arrow-right-circle-fill"></i> <?=t("STRATEGY","STRATEGY")?>: <?= $strategy['strategy_name'] ?>
            </tr>
            <tr class="bg-secondary text-white">
                <td><i class="bi bi-arrow-right-circle-fill"></i> <?=t("DESIGN PRINCIPLE","DESIGN PRINCIPLE")?>:
                    <?= $strategy['design_principle'] ?>
                    <?php snippet('show-translatable-content', ['content'=>"STRATEGY: " . $strategy['strategy_name']  . "  DESIGN PRINCIPLE: " . $strategy['design_principle'] , 'showButton'=>!$editTeam,'showContent'=>false]) ?>
            </tr>
        <?php
    }
        ?>
    </table>
  <?php endif ?>
<?php endforeach ?>
<?php
    if (!$hideCollaboration) 
    {
        if ($editTeam)
        {
        snippet('show-appreciations', ['contentType'=>'Function', 'contentId'=>$function['id']]);
        snippet('show-comments',['contentType'=>'Function','contentId'=>$function['id']]);
            if (isset($viewedTeam['area']))
            {
?>
            <?php if ($researchPageUrl=getCollabUrl($collaborationPoints, 'task-share-research-questions')) :?>
    <a href="<?= $researchPageUrl?>" class="btn btn-outline-primary"><?=t("EDIT RESEARCH QUESTIONS","EDIT RESEARCH QUESTIONS")?></a>
            <?php endif ?>
            <?php if ($strategiesPageUrl=getCollabUrl($collaborationPoints, 'task-share-natural-strategies')) :?>    
    <a href="<?= $strategiesPageUrl?>" class="btn btn-outline-primary"><?=t("EDIT NATURAL STRATEGIES AND DESIGN PRINCIPLES","EDIT NATURAL STRATEGIES AND DESIGN PRINCIPLES")?></a>
            <?php endif ?>
<?php
            }
        }
        else
        {
?>
    <?php snippet('show-appreciation-button',['contentType'=>'Function', 'contentId'=>$function['id']]) ?>
    <?php snippet('show-comment-box', ['contentType'=>'Function', 'contentId'=>$function['id']]) ?>
<?php
        }
    }
?>
<?php else : ?>
  <p><?=t("No Research Questions have been shared","No Research Questions have been shared")?></p>
<?php endif ?>