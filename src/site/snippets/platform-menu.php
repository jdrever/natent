<header class="p-1 bg-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark mx-3">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li>
        <a href="/platform/" class="nav-link px-2 text-white">LEARNING JOURNEY</a>
      </li>
      <li>
        <a href="/team-page/" class="nav-link px-2 text-white"><i class="bi bi-person-heart"></i> TEAM PAGE</a>
      </li>
      <li>
        <a href="/other-teams/" class="nav-link px-2 text-white"><i class="bi bi-search-heart"></i>OTHER TEAMS</a>
      </li>
      <li>
        <a href="/commons/" class="nav-link px-2 text-white"><i class="bi bi-cc-circle-fill"></i>CREATIVE COMMONS</a>
      </li>
      <?php if ($user = $kirby->user()): ?>
      <li>
        <a href="<?= url('logout') ?> " class="nav-link px-2 text-white"><i class="bi bi-door-closed-fill"></i>LOGOUT</a>
      </li>
      <?php else: ?>
      <li>
        <a href="/login/" class="nav-link px-2 text-white"><i class="bi bi-door-open-fill"></i>LOGIN</a>
      </li>
      <?php endif ?>
    </ul>
  </nav>
</header>