<h4><?=t("Design")?></h4>
<?php
if ((isset($viewedTeam['design_idea_file']))&&!empty($viewedTeam['design_idea_file'])) :
    snippet('show-file',['fileUrl'=>$viewedTeam['design_idea_file'],'altText'=>"Design Solution" ]);
else : ?>
    <p><?=t("Not yet uploaded")?>.</p>
<?php endif ?>

<h4>YouTube Video</h4>
<?php
if (isset($viewedTeam['design_idea_you_tube_id'])&&!empty($viewedTeam['design_idea_you_tube_id'])) :
?>
    <iframe loading="lazy" title="'Design Solution" width="500" height="281" src="https://www.youtube.com/embed/<?= $viewedTeam['design_idea_you_tube_id'] ?>?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
<?php else: ?>
    <p><?=t("Not yet uploaded")?>.</p>
<?php endif;
if ($editTeam) :
    if (isset($viewedTeam['design_idea_you_tube_id'])||isset($viewedTeam['design_idea_file'])) :
        if ($designPageUrl=getCollabUrl($collaborationPoints, 'task-design')) :?>
      <a href="<?= $designPagUrl?>" class="btn btn-outline-primary"><?=t('EDIT DESIGN','EDIT DESIGN')?></a>
        <?php endif ?>
      <?php snippet('show-appreciations', ['contentType'=>'Design Idea', 'contentId'=>$viewedTeam['team_design_idea_id']]) ?>
      <?php snippet('show-comments',['contentType'=>'Design Idea', 'contentId'=>$viewedTeam['team_design_idea_id']]) ?>

    <?php endif;
else :
?>
     <?php snippet('show-appreciation-button',['contentType'=>'Design Idea', 'contentId'=>$viewedTeam['team_design_idea_id']]) ?>
     <?php snippet('show-comment-box', ['contentType'=>'Design Idea', 'contentId'=>$viewedTeam['team_design_idea_id']])?>
<?php endif ?>
