<?php if ($latestComments||$latestAppreciations) : ?>
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
                  on your  <?=$comment['content_type']?> by
                  <a href="/other-team-page/?teamId=<?=$comment['team_id']?>"><?=$comment['team_name']?></a>
                  <br>
                  <i class="bi bi-quote"></i>
                  <i><?=substr($comment['comment'],0,20)?></i>
                  <i class="bi bi-three-dots"></i>
                </small>
              </p>
    <?php endforeach ?>
            </div>
          </div>
        </div>
      <?php //TODO: get proper url for comments page
      $commentsPage=$site->find("/view-all-comments"); ?>
    <?php if ($commentsPage) : ?>
      <a href="<?= $commentsPage->url()?>"><?=($commentsPage->pageTitle()->isNotEmpty()) ? $commentsPage->pageTitle() : $commentsPage->title() ?></a>
    <?php endif ?>
  <?php endif ?>
  <?php if ($latestAppreciations) : ?>
        <div class="accordion-item">
            <h2 class="accordion-appreciations" id="headingAppreciations">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseAppreciations" aria-expanded="false" aria-controls="collapseAppreciations">
                <?=t("See Latest Appreciations")?><span class="badge text-bg-primary m-2"><?=count($latestAppreciations)?></span>
              </button>
            </h2>
            <div id="collapseAppreciations" class="accordion-collapse collapse" aria-labelledby="headingAppreciations">
              <div class="accordion-body">
    <?php foreach ($latestAppreciations as $appreciation) : ?>
                <p class="p-1 border">
                  <small>
                    <i class="bi bi-stars"></i>
                    of your <?=$appreciation['content_type']?>  by
                    <a href="/other-team-page/?teamId=<?=$appreciation['team_id']?>"><?=$appreciation['team_name']?></a>
                  </small>
                </p>

    <?php endforeach ?>
    </div>
            </div>
      </div>
  <?php endif ?>    
    </div>
<?php endif ?>