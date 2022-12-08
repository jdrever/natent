<?php snippet('header') ?>

<h1><?= $page->title()->html() ?></h1>

<?php if($error): ?>
<div class="alert"><?= $page->alert()->html() ?></div>
<?php endif ?>

<form method="post" action="<?= $page->url() ?>">
  <div>
    <label for="email"><?= $page->username()->html() ?></label>
    <input type="email" id="email" name="email" value="<?= get('email') ? esc(get('email'), 'attr') : '' ?>">
  </div>
  <div>
    <label for="password"><?= $page->password()->html() ?></label>
    <input type="password" id="password" name="password" value="<?= get('password') ? esc(get('password'), 'attr') : '' ?>">
  </div>
  <div>
    <input type="submit" name="login" value="<?= $page->button()->html() ?>">
  </div>
</form>

<?php snippet('footer') ?>