<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>

<div class="container my-4">
  <h1 class="pb-2 border-bottom"><i class="bi bi-door-open-fill"></i> <?=$page->title()->html()?></h1>
  <?php if($error): ?>
  <div class="alert"><?= $page->alert()->html() ?></div>
  <?php endif ?>

    <form method="post" action="<?= $page->url() ?>">
      <fieldset>
          <p class="required"><?=$page->requiredFieldsLabel()?></p>
          <ol class="list-unstyled">
              <li class="mb-3">
                  <label for="email" class="form-label"><?= $page->username()->html() ?>:
              </label>
                  <input type="text" name="email" required="required" aria-required="true" class="form-control" value="<?= get('email') ? esc(get('email'), 'attr') : '' ?>">
              </li>
              <li class="mb-3">
                  <label for="password" class="form-label">
                  <?= $page->password()->html() ?>:

              </label>
                  <input type="text" name="password" required="required" aria-required="true" class="form-control" value="<?= get('password') ? esc(get('password'), 'attr') : '' ?>">
              </li>
              <li class="submit-buttons">
                  <input type="submit" value="<?= $page->button()->html() ?>" class="btn btn-primary">
              </li>
          </ol>
      </fieldset>
  </form>

<?php snippet('footer') ?>