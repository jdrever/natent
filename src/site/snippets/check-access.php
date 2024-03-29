<?php
if (!isset($showExampleTeamText)) $showExampleTeamText=true;
?>

<?php if (!$userLoggedIn) : ?>
<div class="alert alert-info p-2" role="alert">
  <h2><i class="bi bi-info-square-fill"></i> <?=t("Register to access collaboration features","Register to access collaboration features")?></h2>
  <p><?=t("Everyone can explore the Natural Entrepreneurs Learning Journey","Everyone can explore the Natural Entrepreneurs Learning Journey")?>.</p>
  <p><a class="btn btn-primary m-2" href="<?=$registerPage->url()?>"><?=$registerPage->title()?></a></p>
  <p><?=t("Or if you already have a username and password, then","Or if you already have a username and password, then")?> <a class="btn btn-primary" href="<?=$loginPage->url()?>"><?=$loginPage->title()?></a></p>

  <?php if ($showExampleTeamText) : ?>
  <p><?=t("The information below is taken from the Example Team","The information below is taken from the Example Team, and is intended to give an idea of what a good response to this task might look like.  You can continue to browse through the Learning Journey by clicking the NEXT button below")?>.
  </p>
  <?php endif ?>
</div>
<?php endif ?>