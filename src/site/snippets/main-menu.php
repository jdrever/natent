<?php 
$homePage=$site->url();
$aboutPage=$site->find('/about');
$forTeachersPage=$site->find('/for-teachers');
$forStudentsPage=$site->find('/for-students');
$platformPage=$site->find('/platform');
$contactPage=$site->find('/contact');
?>
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
            <a href="<?=$site->url()?>" class="nav-link active px-2"><?=t('Home','Home')?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$aboutPage->url()?>" class="nav-link px-2"><?=$aboutPage->pageTitle()->isNotEmpty() ? $aboutPage->pageTitle() : $aboutPage->title()?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$forTeachersPage->url()?>" class="nav-link px-2"><?=$forTeachersPage->pageTitle()->isNotEmpty() ? $forTeachersPage->pageTitle() :  $forTeachersPage->title()?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$forStudentsPage->url()?>" class="nav-link px-2"><?=$forStudentsPage->pageTitle()->isNotEmpty() ? $forStudentsPage->pageTitle() : $forStudentsPage->title()?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$platformPage->url()?>" class="nav-link px-2"><?=t('Platform','Platform')?></a>
          </li>
          <li class="nav-item">
            <a href="<?=$contactPage->url()?>" class="nav-link px-2"><?=$contactPage->pageTitle()->isNotEmpty() ? $contactPage->pageTitle() :  $contactPage->title()?></a>
          </li>
        </ul>
        <div class="col-md-3 text-end-md px-2">
          <?php snippet('language-switcher'); ?> 
        </div>
      </div>
    </div>
  </nav>
 