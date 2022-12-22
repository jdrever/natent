<?php 
$homePage=$site->find('/');
$aboutPage=$site->find('/about');

?>


  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a href="/"
         class="navbar-brand d-flex align-items-center text-decoration-none lh-sm">
        <img class="img-fluid m-1" src="/assets/images/natent-logo.min.svg" width="50"/>
        Natural
        <br>
        Entrepreneurs
      </a>
      <button class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navBar"
              aria-controls="navBar"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="font-size:.8em"></span><span class="px-1" style="font-size: .8em;">Menu</span>
      </button>
      <div class="collapse navbar-collapse" id="navBar">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="<?=$homePage->url()?>" class="nav-link active px-2"><?=$homePage->title()?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$aboutPage->url()?>" class="nav-link px-2"><?=$aboutPage->title()?></a>
          </li>
          <li class="nav-item">
            <a href="/for-teachers/" class="nav-link px-2">For Teachers</a>
          </li>
          <li class="nav-item">
            <a href="/for-students/" class="nav-link px-2">For Students</a>
          </li>
          <li class="nav-item">
            <a href="/platform/" class="nav-link px-2">The Platform</a>
          </li>
          <li class="nav-item">
            <a href="/contact/" class="nav-link px-2">Contact Us</a>
          </li>
        </ul>
        <div class="col-md-3 text-end-md px-2">
          <?php snippet('language-switcher'); ?> 
        </div>
      </div>
    </div>
  </nav>
 