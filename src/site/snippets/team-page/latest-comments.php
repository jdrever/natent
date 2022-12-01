<?php if ($latestComments||$latestAppreciations) : ?>
<div class="container">
  <div class="row">
    <div class="col bg-light d-none d-lg-block">
      <h5><?=t("Latest Comments")?></h5>

  <?php if ($latestComments):?>
    <?php foreach ($latestComments as $comment) : ?>
      <p class="p-1 m-0 border"><small><i class="bi bi-chat-fill"></i> on your <?=$comment['content_type']?> by <a
            href="/other-team-page/?teamId=<?=$comment['team_id']?>"><?=$comment['team_name']?></a>
          <br><i class="bi bi-quote"></i><i><?=substr($comment['comment'],0,20)?></i><i
            class="bi bi-three-dots"></i></small></p>
    <?php endforeach ?>
      <?php $commentsPage=$site->find("/view-all-comments"); ?>
    <?php if ($commentsPage) : ?>
      <a href="<?= $commentsPage->url()?>"><?=($commentsPage->pageTitle()->isNotEmpty()) ? $commentsPage->pageTitle() : $commentsPage->title() ?></a>
    <?php endif ?>
  <?php else : ?>
      <p><?=t("You don't have any comments yet")?>.</p>

  <?php endif ?>
    </div>
  <?php if ($latestAppreciations) : ?>
    <div class="col bg-light d-none d-lg-block">
      <h5><?=t("Latest Appreciations")?></h5>
    <?php foreach ($latestAppreciations as $appreciation) : ?>
      <p class="p-1 m-0 border"><small><i class="bi bi-stars"></i> of your <?=$appreciation['content_type']?> by <a
            href="/other-team-page/?teamId=<?=$appreciation['team_id']?>"><?=$appreciation['team_name']?></a></small>
      </p>
    <?php endforeach ?>

  <?php else: ?>
      <p><?=t("You don't have any appreciations yet")?>.</p>
  <?php endif ?>
    </div>
  </div>
</div>
<?php endif ?>