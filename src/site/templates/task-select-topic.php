<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<?php if ($showTopics) : ?>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($areas as $area) : ?>
      <div class="col">
        <div class="card shadow-sm">
          <img class="img-fluid" src="<?=url('/assets/images/SDGs/' . $area['id'] . $imageFileEnding) ?>"
            alt="<?=$area['name']?>">
          <div class="card-body">
            <p class="card-text"><strong><?=trim($area['name'])?></strong><br /><?=trim($area['description'])?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="<?=$page->url()?>?topicId=<?=$area['id'] ?>"
                  class="btn btn-sm btn-primary float-end"><?=$page->selectTopicButton()?> &#8594;</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
<?php endif ?>
<?php if ($showChallenges) : ?>
<h3><?=$page->listOfChallengesHeading()?> <?=t($topic['name'])?></h3>
<?php if ($challenges) : ?>
  <?php foreach ($challenges as $challenge) : ?>
<div class="container bg-light m-1">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-text"><?=$challenge['name']?></h4>
            <p><?=$challenge['description']?></p>

    <?php if (isset($challenge['further_information'])) :?>
            <p><?=$challenge['further_information']?></p>
    <?php endif  ?>

            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <form action="<?= $page->url()?>" method="post">
                        <input type="hidden" id="topicId" name="topicId" value="<?=$topic['id'] ?>">
                        <input type="hidden" id="challengeId" name="challengeId" value="<?=$challenge['id']?>">
                        <input type="submit" class="btn btn-primary float-end" value="<?=$page->selectChallengeButton()?>  &#8594;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <?php endforeach ?>
<? 
else :
?>
<p><?=$page->noChallengesText() ?></p>
<?php endif ?>

<h4><?=$page->createChallengeHeading()?> <?=t($topic['name'])?></h4>
<p><?=$page->createChallengeText()?>:</p>

<form class="form-inline" method="post" action="<?= $page->url()?>">
    <input type="hidden" name="topicId" id="topicId" value="<?=$topic['id'] ?>">
    <label for="bespokeChallenge" class="m-1"><?=$page->enterChallengeLabel()?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="bespokeChallenge"
        name="bespokeChallenge"><?=htmlspecialchars($bespokeChallenge) ?></textarea>
    <input type="submit" class="btn btn-primary float-end" value="<?=$page->createChallengeButton()?> &#8594;">
</form>
<br>
<h3><?=$page->teamsTopicHeading()?></h3>
<?php 


if ($teams)
{
?>
<table class="table table-success table-striped">
    <tr>
        <th><?=t("Team Name","Team Name")?></th>
        <th><?=t("Topic","Topic")?></th>
        <th><?=t("Challenge","Challenge")?></th>
        <th><?=t("Points","Points")?></th>
    </tr>

    <?php  
  $otherTeamPage=url("other-teams");

  foreach($teams as $team)
  {
  ?>
    <tr>
        <td><a href="<?=$otherTeamPage . '/?teamId=' . $team['id']?>"><?=$team['name']?></a></td>
        <td><?=t($team['area'], $team['area'])?></td>
        <td><?=t($team['challenge'], $team['challenge'])?></td>
        <td><?=$team['points']?></td>
    </tr>

    <?php
  }
?>
</table>
<?php
}
else
{
?>
<p><?=$page->noOtherTeams()?></p>
<?php
}
?>

</div>
  
<?php endif ?>


<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>