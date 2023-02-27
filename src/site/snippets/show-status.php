<?php if (isset($status)) : ?>
  <?php if ($status==='task-ok'||$status==='task-commons-ok'||$status==='comment-ok'||$status==="appreciation-ok"||$status==="recommend-ok") : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi-hand-thumbs-up-fill"></i>
    <?php if ($status==='task-ok') : ?>
    <?=t("Thankyou for completing this collaboration point!","Thankyou for completing this collaboration point!")?>
    <?php endif ?>
    <?php if ($status==='task-commons-ok') : ?>
      <?=t("Thankyou for completing this collaboration point and for adding resources to the Commons!","Thankyou for completing this collaboration point and for adding resources to the Commons!")?>
    <?php endif ?>
    <?php if ($status==='comment-ok') : ?>
      <?=t("Thankyou for adding your comment!","Thankyou for adding your comment!")?>
    <?php endif ?>
    <?php if ($status==='appreciation-ok') : ?>
      <?=t("Thankyou for adding your appreciation!","Thankyou for adding your appreciation!")?>
    <?php endif ?>
    <?php if ($status==='recommend-ok') : ?>
      <?=t("The recommendation for the resource has been updated","The recommendation for the resource has been updated")?>
    <?php endif ?>
  </h2>


  <p class="lead">
<?php if ($pointsAdded>0) : ?>
  <i class="bi bi-star"></i><?=t("Your team has gained")?> <strong><?=$pointsAdded ?></strong> <?=t("points and now has a total of")?> <strong><?=$team['points']?></strong> <?=t("points","points")?>. 
<?php endif ?>

<?php if ($maximumPoints==='Y') : ?>
  <p class="h2"><i class="bi bi-stars"></i></i><strong><?=t("Congratulatons! Your team now has reached the maximum score on the platform!","Congratulatons! Your team now has reached the maximum score on the platform!")?></strong></p>
<?php endif ?>

<?php if ($pointsAddedOtherTeam>0) : ?>
  <i class="bi bi-star"></i><?=t("The team you engaged with gained","The team you engaged with gained")?> <strong><?=$pointsAddedOtherTeam ?></strong> <?=t("points","points")?>. 
<?php endif ?>
  <?php if ($status==='task-ok'||$status==='task-commons-ok') : ?>
    <?=t("Your Team Page will have been updated. Other teams will be able to see what you have been working on, and you can check out other teams to get inspiration","Your Team Page will have been updated. Other teams will be able to see what you have been working on, and you can check out other teams to get inspiration")?>.
    <p>
      <a href="<?=$teamPage->url()?>" class="btn btn-outline-primary m-2"><i class="bi bi-person-heart"></i>  <?=$teamPage->title()?></a>
      <a href="<?=$otherTeamsPage->url()?>"
        class="btn btn-outline-primary"><i class="bi bi-search-heart"></i> <?=$otherTeamsPage->title()?></a>
    </p>
    <?php endif ?>
</div>
  <?php endif ?>
  <?php if ($status==='task-error'||$status==='task-commons-error'||$status==='comment-error'||$status==="appreciation-error"||$status==="recommend-error") : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi-hand-thumbs-up-fill"></i>
    <?php if ($status==='task-error') : ?>
    <?=t("An error occured while completing this collaboration point","An error occured while completing this collaboration point")?>
    <?php endif ?>
    <?php if ($status==='task-commons-error') : ?>
      <?=t("An error occured while completing this collaboration point andadding resources to the Commons","An error occured while completing this collaboration point andadding resources to the Commons")?>
    <?php endif ?>
    <?php if ($status==='comment-error') : ?>
      <?=t("An error occured while adding your comment","An error occured while adding your comment")?>
    <?php endif ?>
    <?php if ($status==='appreciation-error') : ?>
      <?=t("An error occured while adding your appreciation!","An error occured while adding your appreciation!")?>
    <?php endif ?>
    <?php if ($status==='recommend-error') : ?>
      <?=t("An error occured while updating your recommendation!","An error occured while updating your recommendation!")?>
    <?php endif ?>
  </h2>
  <p class="lead">
    ERROR MESSAGE: <?=$errorMessage?> 
    </p>
</div>
  <?php endif ?>
<?php endif ?>