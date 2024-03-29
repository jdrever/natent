<div class="container bg-light p-3">

  <form class="form-inline" method="post">
    <label for="context" class="m-1"><?=t('Enter your Context','Enter your Context')?>:</label>
    <div id="contextHelp" class="form-text"><?= t('Enter at least 50 characters to receive points!','Enter at least 50 characters to receive points!')?></div>
    <textarea class="form-control m-1" aria-label="With textarea" id="context" name="context" rows="8"
    <?=($userLoggedIn) ? 'required' : 'readonly'?> aria-describedby="contextHelp"><?=$teamContext?></textarea>

    <?php snippet('add-to-commons-form') ?>

    <?php snippet('guide-navigation', ['taskButton'=> t('SHARE YOUR CONTEXT','SHARE YOUR CONTEXT')]) ?>

  </form>
</div>