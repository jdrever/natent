<?php
//TODO: update to proper url
$pitchVideoPage="";
?>
<h3><?=t("Pitch Video")?></h3>
<?php
if (isset($viewedTeam['pitch_video_you_tube_id'])&&!empty($viewedTeam['pitch_video_you_tube_id'])) :
?>
    <iframe loading="lazy" title="'Pitch Video" width="500" height="281" src="https://www.youtube.com/embed/<?= $viewedTeam['pitch_video_you_tube_id'] ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

<?php else : ?>
    <p><?=t("Not yet uploaded")?>.</p>
<?php endif;
if ($editTeam) : ?>
<a href="<?= $pitchVideoPage ?>" class="btn btn-outline-primary"><?=t("EDIT PITCH VIDEO")?></a>
  <?php snippet('show-appreciations', ['appreciations'=>$pitchAppreciations]) ?>
  <?php snippet('show-comments',['comments'=>$challengeComments]) ?>
<?php else : ?>
  <?php snippet('show-appreciation-button',['appreciations'=>$pitchAppreciations, 'contentType'=>'Business Canvas', 'contentId'=> $viewedTeam['team_business_canvas_id']]) ?>
  <?php snippet('show-comment-box', ['comments'=>$profileComments, 'contentType'=>'Business Canvas','contentId'=> $viewedTeam['team_business_canvas_id']])?>
<?php endif ?>
