<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<?php if ($showTopics) : ?>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php 
$challengePage="#";
foreach ($areas as $area) : ?>
      <div class="col">
        <div class="card shadow-sm">
          <img class="img-fluid" src="<?=url('/assets/images/SDGs/' . $area['id'] . $imageFileEnding) ?>"
            alt="<?=$area['name']?>">
          <div class="card-body">
            <p class="card-text"><strong><?=trim($area['name'])?></strong><br /><?=trim($area['description'])?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="#/?topicId=<?=$area['id'] ?>"
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
<?php if ($showTopics) : ?>

<h3><?=pll__("List of Challenges for")?> <?=pll__($area['name'])?></h3>
<?php 
if ($challenges)
{
  foreach ($challenges as $challenge) 
  { ?>
<div class="container bg-light m-1">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-text"><?=$challenge['name']?></h4>
            <p><?=$challenge['description']?></p>

<?php 
if (isset($challenge['further_information']))
{
?>
            <p><?=$challenge['further_information']?></p>
<?php
}
?>

            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <form action="<?= $collaborationPointPage?>" method="post">
                        <input type="hidden" id="point" name="point" value="<?=$collaborationPointType?>">
                        <input type="hidden" id="areaId" name="areaId" value="<?=$areaId ?>">
                        <input type="hidden" id="challengeId" name="challengeId" value="<?=$challenge['id']?>">
                        <input type="submit" class="btn btn-primary float-end" value="<?=pll__("SELECT THIS CHALLENGE")?> &#8594;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
  }
}
else
{
  echo("<p>" . pll__("There are not any set Challenges for this topic yet") . ".</p>");
} 
?>

<h4><?=pll__("Create your own Challenge for")?> <?=pll__($area['name'])?></h4>
<p><?=pll__("If you would prefer to create your own Challenge, enter it in the box below")?>:</p>

<form class="form-inline" method="post" action="<?= $collaborationPointPage?>">
    <input type="hidden" name="point" id="point" value="<?=$collaborationPointType?>">
    <input type="hidden" name="areaId" id="areaId" value="<?=$areaId ?>">
    <label for="school-info" class="m-1"><?=pll__("Enter your challenge")?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="bespokeChallenge"
        name="bespokeChallenge"><?=htmlspecialchars($bespokeChallenge) ?></textarea>
    <input type="submit" class="btn btn-primary float-end" value="<?=pll__("UPLOAD YOUR OWN CHALLENGE")?> &#8594;">
</form>
<br>
<h3><?=pll__("Teams Working on this Topic")?></h3>
<?php 


if ($teams)
{
?>
<table class="table table-success table-striped">
    <tr>
        <th><?=pll__("Team Name")?></th>
        <th><?=pll__("Topic")?></th>
        <th><?=pll__("Challenge")?></th>
        <th><?=pll__("Points")?></th>
    </tr>

    <?php  
  $otherTeamPage=getTranslatedPageByTitle("Other Team Page");

  foreach($teams as $team)
  {
  ?>
    <tr>
        <td><a href="<?=get_permalink($otherTeamPage) . '/?teamId=' . $team['id']?>"><?=$team['name']?></a></td>
        <td><?=pll__($team['area'])?></td>
        <td><?=pll__($team['challenge'])?></td>
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
<p><?=pll__("There are no other teams working on this Topic at the moment - so you could be the first!")?></p>
<?php
}
?>

</div>
  
<?php endif ?>


<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>