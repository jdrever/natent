<div class="container bg-light p-3">
<?php if (isset($teamArea)) 
{
?>
  <form class="form-inline" method="post" action="<?=$page->url()?>">
        <label for="recommendations" class="m-1"><?=t('Describe how/if your final Design Solution has addressed the Context and Needs you identified, and which Nature\'s Unifying Patterns have helped you','Describe how/if your final Design Solution has addressed the Context and Needs you identified, and which Nature\'s Unifying Patterns have helped you')?>:</label>
        <div id="recommendationsHelp" class="form-text"><?= t('Enter at least 50 characters to receive points!','Enter at least 50 characters to receive points!')?></div>
        <textarea class="form-control m-1" aria-label="With textarea" rows="8" id="recommendations"
        name="recommendations" aria-describedby="recommendationsHelp"><?=str_replace("<br>","\r\n", $teamRecommendations)?></textarea>
        <?php snippet('add-to-commons-form') ?> 
        <?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR RECOMMENDATIONS','SHARE YOUR RECOMMENDATIONS')]) ?>
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