
<?php if (isset($status)) : ?>
  <?php if ($status==='task-ok'||$status==='task-commons-ok'||$status==='comment-ok'||$status==="appreciation-ok") : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi-hand-thumbs-up-fill"></i>
    <?php if ($status==='task-ok') : ?>
    Thankyou for completing this collaboration point!
    <?php endif ?>
    <?php if ($status==='task-commons-ok') : ?>
    Thankyou for completing this collaboration point and for adding resources to the Commons!
    <?php endif ?>
    <?php if ($status==='comment-ok') : ?>
    Thankyou for adding your comment!
    <?php endif ?>
    <?php if ($status==='appreciation-ok') : ?>
    Thankyou for adding your appreciation!
    <?php endif ?>
  </h2>


  <p class="lead">

<?php if ($pointsAdded>0) : ?>
  <i class="bi bi-star"></i>Your team has gained <strong><?=$pointsAdded ?></strong> points and now has a total of <strong><?=$team['points']?></strong> points. 
<?php endif ?>
<?php if ($pointsAddedOtherTeam>0) : ?>
  <i class="bi bi-star"></i>The team you engaged with gained <strong><?=$pointsAddedOtherTeam ?></strong> points. 
<?php endif ?>
  <?php if ($status==='task-ok'||$status==='task-commons-ok') : ?>
    Your Team Page will have been updated. Other teams will be able to see what you've been working on, and you can
    check out other teams to get inspiration.
    <p>
      <a href="<?=$teamPage->url()?>" class="btn btn-outline-primary m-2"><i class="bi bi-person-heart"></i>  <?=$teamPage->title()?></a>
      <a href="<?=$otherTeamsPage->url()?>"
        class="btn btn-outline-primary"><i class="bi bi-search-heart"></i> <?=$otherTeamsPage->title()?></a>
    </p>
    <?php endif ?>
</div>
  <?php endif ?>


  <?php if ($status==='err') : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi bi-exclamation-square-fill"></i>
    An error has occurred while attempting to complete this collaboration point.
  </h2>
  <p class="lead">
    ERROR MESSAGE: <?=$errorMessage?> 
    </p>
</div>
  <?php endif ?>
<?php endif ?>