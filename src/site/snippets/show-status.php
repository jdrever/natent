<?php if (isset($status)) : ?>
  <?php if ($status==='ok') : ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi-hand-thumbs-up-fill"></i>
    Thankyou for completing this collaboration point!
  </h2>
  <p class="lead">
    Your Team Page will have been updated. Other teams will be able to see what you've been working on, and you can
    check out other teams to get inspiration.</a>
    <p>
      <a href="#" class="btn btn-outline-primary m-2">Go to your Team Page</a><a href="#"
        class="btn btn-outline-primary">Check out other Teams</a>
    </p>
</div>
  <?php endif ?>
  <?php if ($status==='err') : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h2>
    <i class="bi bi-exclamation-square-fill"></i>
    An error has occurred while attempting to complete this collaboration point.
  </h2>
  <p class="lead">
    ERROR MESSAGE: <?=$errorMessage?> 
    </p>
</div>
  <?php endif ?>
<?php endif ?>