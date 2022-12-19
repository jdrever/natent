<header class="p-1 bg-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark mx-3">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li>
        <a href="<?=$platformPage->url()?>" class="nav-link px-2 text-white"><?=$platformPage->pageTitle()->isNotEmpty() ? $platformPage->pageTitle() : $platformPage->title()?></a>
      </li>
      <?php if ($userLoggedIn) :?>
      <li>
        <a href="<?=$teamPage->url()?>" class="nav-link px-2 text-white"><i class="bi bi-person-heart"></i> <?=$teamPage->pageTitle()->isNotEmpty() ? $teamPage->pageTitle() : $teamPage->title()  ?></a>
      </li>
      <li>
        <a href="<?=$otherTeamsPage->url()?>" class="nav-link px-2 text-white"><i class="bi bi-search-heart"></i><?=$otherTeamsPage->pageTitle()->isNotEmpty() ? $otherTeamPage->pageTitle() : $otherTeamsPage->title()  ?></a>
      </li>
      <li>
        <a href="<?=$commonsPage->url()?>" class="nav-link px-2 text-white"><i class="bi bi-cc-circle-fill"></i><?=$commonsPage->pageTitle()->isNotEmpty() ? $commonsPage->pageTitle() : $commonsPage->title() ?></a>
      </li>
        <?php if ($userRole=="TEACHER"||$userRole=="ADMIN"||$userRole=="GLOBAL") : ?>
          <li>
        <a href="<?=$adminPage->url()?>" class="nav-link px-2 text-white"><i class="bi bi-door-closed-fill"></i><?=$adminPage->pageTitle()->isNotEmpty() ? $adminPage->pageTitle() : $adminPage->title() ?></a>
      </li>
        <?php endif ?>
      <li>
        <a href="<?= url('logout') ?> " class="nav-link px-2 text-white"><i class="bi bi-door-closed-fill"></i><?=t('Logout', 'Logout')?></a>
      </li>
      <?php else: ?>
        <?php if (isset($exampleTeam)) : ?>
          <li>
        <a href="<?= $exampleTeamPage->url() ?>" class="nav-link px-2 text-white"><i class="bi bi-person-heart"></i><?=$exampleTeamPage->pageTitle()->isNotEmpty() ? $exampleTeamPage->pageTitle() : $exampleTeamPage->title() ?></a>
      </li>        
        <?php endif ?>
      <li>
        <a href="<?= $loginPage->url() ?>" class="nav-link px-2 text-white"><i class="bi bi-door-open-fill"></i><?=$loginPage->pageTitle()->isNotEmpty() ? $loginTeamPage->pageTitle() : $loginPage->title() ?></a>
      </li>
      <?php endif ?>
    </ul>
    <?php snippet('show-resume-button') ?>
  </nav>
</header>