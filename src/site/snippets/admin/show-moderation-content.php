<?php
use carefulcollab\helpers as helpers;
  $content=helpers\DataHelper::getModerationContent($contentType, $contentId);
    if ($contentType=="Team Profile")
    {
 ?>
    <b><?=t("Tell us about your team","Tell us about your team")?>:</b><br><?=$content['description']?>
 <?php
    }
    if ($contentType=="Team Challenge")
    {
 ?>
    <b><?=t("Enter your challenge","Enter your challenge")?>:</b><br><?=$content['bespoke_challenge']?>
 <?php
    }
    if ($contentType=="Challenge Definition")
    {
 ?>
    <b><?=t("Enter your Context","Enter your Context")?>:</b><br><?=$content['context']?><br>
    
 <?php
    }
    if ($contentType=="Function")
    {
 ?>
    <b><?=t("Research Question", "Research Question")?>:</b><br><?=$content['biologized_question']?><br>
    
 <?php
    }
    if ($contentType=="Strategy")
    {
 ?>
    <b><?=t("Strategy","Strategy")?>:</b><br><?=$content['strategy_name']?><br>
    <b><?=t("Design Principle","Design Principle")?>:</b><br><?=$content['design_principle']?><br>
    
 <?php
    }
    if ($contentType=="Design Idea")
    {
        if (isset($content['design_idea_file']))
        {
 ?>

    <b><?=t("Upload your Design Solution (use an image file, e.g. JPG or PNG)","Upload your Design Solution (use an image file, e.g. JPG or PNG)") ?>:</b><a href="<?=$content['design_idea_file']?>"><img class="img-fluid" src="<?=$content['design_idea_file']?>" alt="DOWNLOAD"></a><br>
    <?php
        }
        if (isset($content['design_idea_you_tube_id'])&&(!empty($content['design_idea_you_tube_id'])))
        {
    ?>
    <b><?=t("Upload your video presentation to our You Tube channel and share the link here","Upload your video presentation to our You Tube channel and share the link here") ?> :</b><br>    
    <iframe loading="lazy" title="'Design Solution" width="500" height="281" src="https://www.youtube.com/embed/<?= $content['design_idea_you_tube_id'] ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

 <?php
        }
    }
    if ($contentType=="Measure")
    {
 ?>
    <b><?=t("Describe how/if your final Design Solution has met your Statement of Intent, and which Nature's Unifying Patterns have helped you","Describe how/if your final Design Solution has met your Statement of Intent, and which Nature's Unifying Patterns have helped you")?>:</b><br><?=$content['recommendations']?>
 <?php
    }
    if ($contentType=="Business Canvas")
    {
 ?>
    <?php
            if (isset($content['pitch_file']))
            {
     ?>
    
        <b><?=t('Upload your pitch document (use a PDF or image file, e.g. JPG or PNG)','Upload your pitch document (use a PDF or image file, e.g. JPG or PNG)') ?>:</b><a href="<?=$content['pitch_file']?>"><img class="img-fluid" src="<?=$content['pitch_file']?>" alt="DOWNLOAD"></a><br>
        <?php
            }
        if (isset($content['pitch_video_you_tube_id']))
        {
    ?>
    <b><?=t("Upload your pitch video to your You Tube channel and share the link here","Upload your pitch video to your You Tube channel and share the link here") ?>:</b><br>
    <iframe loading="lazy" title="'Design Solution" width="500" height="281" src="https://www.youtube.com/embed/<?= $content['pitch_video_you_tube_id'] ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
 <?php
        }
    }
    if ($contentType=="Comment")
    {
 ?>
    <b><?=t("Comment","Comment")?>:</b><br><?=$content['comment']?>
 <?php
    }
    if ($contentType=="Commons Resource")
    {
 ?>
    <b><?=t("What is the title of your resource?","What is the title of your resource?")?>:</b><br><?=$content['title']?><br>
    <b><?=t("Give a description of your resource","Give a description of your resource")?>:</b><br><?=$content['description']?><br>
    <b><?=t("Enter the website location for your resource (if one exists)","Enter the website location for your resource (if one exists)")?>:</b><br><br><a href="https://<?=$content['url']?>"><?=$content['url']?></a><br>
    <b><?=t("Upload a document (optional - image or PDF only)","Upload a document (optional - image or PDF only)")?>:</b><br><br><?php snippet('show-file', ['fileUrl'=>$content['file_upload_url'],'altText'=>$content['title']])?><br/><?=t("Please check this file")?></a><br>       
 <?php
    }
?>
