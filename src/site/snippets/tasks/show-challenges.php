<h3><?=t('List of Challenges for','List of Challenges for')?> <?=t($topic['name'],$topic['name'])?></h3>
<?php if (count($challenges)>0) : ?>
  <?php foreach ($challenges as $challenge) : ?>
<div class="container bg-light m-1">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-text"><?=$challenge['name']?></h4>
            <p><?=$challenge['description']?></p>

    <?php if (isset($challenge['further_information'])) :?>
            <p><?=$challenge['further_information']?></p>
    <?php endif  ?>
    <?php if ($userLoggedIn) : ?>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <form action="<?= $page->url()?>" method="post">
                      <input type="hidden" id="collabType" name="collabType" value="Challenge">
                        <input type="hidden" id="topicId" name="topicId" value="<?=$topic['id'] ?>">
                        <input type="hidden" id="challengeId" name="challengeId" value="<?=$challenge['id']?>">
                        <input type="submit" class="btn btn-primary float-end" value="<?=t('SELECT THIS CHALLENGE','SELECT THIS CHALLENGE')?>  &#8594;">
                    </form>
                </div>
            </div>
    <?php endif ?>
        </div>
    </div>
</div>
  <?php endforeach ?>
<?php else : ?>
<p><?=t('There are not any set Challenges for this topic yet','There are not any set Challenges for this topic yet') ?></p>
<?php endif ?>

<?php if ($userLoggedIn) : ?>

<h4><?=t('Create your own Challenge for','Create your own Challenge for')?> <?=t($topic['name'])?></h4>
<p><?=t('If you would prefer to create your own Challenge, enter it in the box below','If you would prefer to create your own Challenge, enter it in the box below')?>:</p>

<form class="form-inline" method="post" action="<?= $page->url()?>">
    <input type="hidden" name="topicId" id="topicId" value="<?=$topic['id'] ?>">
    <label for="bespokeChallenge" class="m-1"><?=t('Enter your challenge','Enter your challenge')?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="bespokeChallenge"
        name="bespokeChallenge"><?=htmlspecialchars($bespokeChallenge) ?></textarea>
    <input type="submit" class="btn btn-primary float-end" value="<?=t('CREATE YOUR CHALLENGE','CREATE YOUR CHALLENGE')?> &#8594;">
</form>
<br>
<h3><?=t('Teams Working on this Topic','Teams Working on this Topic')?></h3>
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
<p><?=t('There are no other teams working on this Topic at the moment - so you could be the first!','There are no other teams working on this Topic at the moment - so you could be the first!')?></p>
<?php
}
?>

<?php else: ?>
  <?php snippet('guide-navigation') ?>  
<?php endif ?>
</div>