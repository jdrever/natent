<?php if (!$userLoggedIn) : ?>
<div class="alert alert-info p-2" role="alert">
  <h2><i class="bi bi-info-square-fill"></i> Register to access collaboration features</h2>
  <p>To complete tasks and collaborate with other teams, you will need to register your school with the
    project</p>
  <p><a class="btn btn-primary m-2" href="<?=$registerPage->url()?>"><?=$registerPage->title()?></a></p>
  <p>Or if you already have a username and password, then <a class="btn btn-primary" href="<?=$loginPage->url()?>"><?=$loginPage->title()?></a></p>
  <p>Otherwise, please just click NEXT below to continue to the next step.</p>
</div>
<?php endif ?>