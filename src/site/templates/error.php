<?php snippet('header') ?>
<h1>An error has occurred!</h1>
<?php if (isset($errorMessage)) : ?>
<p><?=$errorMessage?>
<?php endif ?>
<?php snippet('footer') ?>