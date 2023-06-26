<h3><?=t("Pitch", "Pitch")?></h3>

<?php
if ((isset($viewedTeam['pitch_file']))&&!empty($viewedTeam['pitch_file'])) :
    snippet('show-file',['fileUrl'=>$viewedTeam['pitch_file'],'altText'=>"Pitch" ]);
else : ?>
    <p><?=t("Not yet uploaded")?>.</p>
<?php endif ?>
<h4><?=t("Pitch Video", "Pitch Video")?></h4>
<?php
if (isset($viewedTeam['pitch_video_you_tube_id'])&&!empty($viewedTeam['pitch_video_you_tube_id'])) :
?>
    <iframe loading="lazy" title="'Pitch Video" width="500" height="281" src="https://www.youtube.com/embed/<?= $viewedTeam['pitch_video_you_tube_id'] ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

<?php else : ?>
    <p><?=t("Not yet uploaded", "Not yet uploaded")?>.</p>
<?php endif;
if (!$hideCollaboration) :
  if ($editTeam) : ?>
    <?php if ($pitchPageUrl=getCollabUrl($collaborationPoints, 'task-share-pitch-deck')) :?>
<a href="<?= $pitchPageUrl ?>" class="btn btn-outline-primary"><?=t("EDIT PITCH", "EDIT PITCH")?></a>
    <?php endif ?>
  <?php snippet('show-appreciations', ['contentType'=>'Business Canvas', 'contentId'=> $viewedTeam['team_business_canvas_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Business Canvas', 'contentId'=> $viewedTeam['team_business_canvas_id']]) ?>
  <?php else : ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Business Canvas', 'contentId'=> $viewedTeam['team_business_canvas_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Business Canvas','contentId'=> $viewedTeam['team_business_canvas_id']])?>
  <?php endif ?>
<?php endif ?>