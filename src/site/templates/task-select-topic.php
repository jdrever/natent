<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>
<?php snippet('check-access', ['showExampleTeamText'=>false]) ?>
<?php snippet('tasks/show-current-topics') ?>
<?php snippet('tasks/show-example-team-topics')?>
<?php if ($showTopics) : ?>
  <?php snippet('tasks/show-topics')?>
<?php endif ?>
<?php if ($showChallenges) : ?>
  <?php snippet('tasks/show-challenges')?>
<?php endif ?>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>