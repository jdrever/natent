<?php
if (!isset($fieldName))
{
  $fieldName="mainContent";
}
//seem to need to call the $page object before getting the field
$pageTitle=$page->title();
?>

<div class="container m-0">
<?php foreach ($page->content->get($fieldName)->toLayouts() as $layout) : ?>
  <div class="row" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column) : ?>
    <div class="col-sm-<?= $column->span() ?>">
      <?= $column->blocks() ?>
    </div>
  <?php endforeach ?>
  </div>
<?php endforeach ?>
</div>