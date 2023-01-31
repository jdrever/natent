<?php snippet('header') ?>
<?php snippet ('show-simple-hero') ?>
<div class="container my-4">
  <?php snippet ('show-blocks') ?>

  <?php if($success): ?>
  <div class="alert alert-success">
    <p><?= $success ?></p>
  </div>
  <?php else: ?>
  <?php if (isset($alert['error'])): ?>
  <div class="alert alert-danger"><?= $alert['error'] ?></div>
  <?php endif ?>

  <style>
    .honeypot {
      position: absolute;
      left: -9999px;
    }
  </style>

  <form class="form-inline" method="post">
    <div class="honeypot">
      <label for="website">Website <abbr title="required">*</abbr></label>
      <input type="url" id="website" name="website" tabindex="-1">
    </div>
    <fieldset>
      <p class="required"><?=$page->allFieldsText()?>.</p>
      <ol class="list-unstyled">
        <li class="mb-3">
          <label for="name" class="form-label"><?=$page->nameLabel()?>:</label>
          <input type="text" name="name" required="required" aria-required="true" class="form-control">
        </li>
        <li class="mb-3">
          <label for="name" class="form-label"><?=$page->schoolLabel()?>:</label>
          <input type="text" name="school" required="required" aria-required="true" class="form-control">
        </li>
        <li class="mb-3">
          <label for="email" class="form-label"><?=$page->emailLabel()?>:</label>
          <input type="email" name="email" required="required" aria-required="true" class="form-control">
        </li>
        <li class="mb-3">
          <label for="name" class="form-label"><?=$page->messageLabel()?>:</label>
          <textarea class="form-control" id="message" name="message"></textarea>
        </li>
      </ol>
    </fieldset>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <input type="submit" value="<?=$page->registerButton()?>" class="btn btn-primary p-3">
    </div>
  </form>
</div>
<?php endif ?>
<?php snippet('footer') ?>