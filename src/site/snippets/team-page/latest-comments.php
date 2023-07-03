<?php 
$otherTeamPage=$site->find('platform/other-team-page');
if ($latestComments||$latestAppreciations) : ?>
<div class="container my-4">
  <div class="accordion accordion-flush" id="accordionCommentsAppreciations">
    <?php if ($latestComments):?>
    <div class="accordion-item">
      <h2 class="accordion-comments" id="headingComments">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
          <?=t("See Latest Comments")?><span class="badge text-bg-primary m-2"><?=count($latestComments)?></span>
        </button>
      </h2>
      <div id="collapseComments" class="accordion-collapse collapse" aria-labelledby="headingComments">
        <div class="accordion-body">
          <?php foreach ($latestComments as $comment) : ?>
          <p class="p-1 border">
            <small>
              <i class="bi bi-chat-fill"></i>
              <?=t('on your','on your')?> <?=t($comment['content_type'],$comment['content_type'])?> <?=t('by','by')?>
              <a href="<?=$otherTeamPage->url()?>?teamId=<?=$comment['team_id']?>"><?=$comment['team_name']?></a>
              <br>
              <i class="bi bi-quote"></i>
              <i><?=$comment['comment']?></i>
            </small>
          </p>
          <?php endforeach ?>
        </div>
        <?php 
      $commentsPage=$site->find("/platform/team-page/team-comments"); ?>
        <?php if ($commentsPage) : ?>
        <a href="<?= $commentsPage->url()?>"
          class="btn btn-primary btn-sm m-2"><?=t('View all Comments received', 'View all Comments received') ?>
          &rarr;</a>
        <?php endif ?>
      </div>
    </div>
    <?php endif ?>
    <?php if ($latestAppreciations) : ?>
    <div class="accordion-item">
      <h2 class="accordion-appreciations" id="headingAppreciations">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseAppreciations" aria-expanded="false" aria-controls="collapseAppreciations">
          <?=t("See Latest Appreciations")?><span
            class="badge text-bg-primary m-2"><?=count($latestAppreciations)?></span>
        </button>
      </h2>
      <div id="collapseAppreciations" class="accordion-collapse collapse" aria-labelledby="headingAppreciations">
        <div class="accordion-body">
          <?php foreach ($latestAppreciations as $appreciation) : ?>
          <p class="p-1 border">
            <small>
              <i class="bi bi-stars"></i>
              <?=t('of your','of your')?> <?=t($appreciation['content_type'],$appreciation['content_type'])?> <?=t('by','by')?>
              <a
                href="<?=$otherTeamPage->url()?>?teamId=<?=$appreciation['team_id']?>"><?=$appreciation['team_name']?></a>
            </small>
          </p>

          <?php endforeach ?>
        </div>
      </div>
    </div>
    <?php endif ?>
  </div>
</div>
<?php endif ?>