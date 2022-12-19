<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<?php snippet('team-page-link')?>

<div class="container bg-light p-3">
<form class="form-inline" method="post" action="<?=$page->url() ?>"
    enctype="multipart/form-data">
    <label for="context" class="m-1"><?=t('Enter your Context','Enter your Context')?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="context" name="context" rows="8" required><?=$team['context']?></textarea>

    <?php /*
    <button type="submit" class="btn btn-primary float-end"><?=$page->shareContextButton()?> <i class="bi bi-arrow-right"></i></button>

    <?php snippet('add-to-commons-form')?>
    */ ?>

    <?php snippet('guide-navigation', ['taskButton'=> t('SHARE YOUR CONTEXT','SHARE YOUR CONTEXT')]) ?>

</form>
</div>

<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>
