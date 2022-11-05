<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>The Careful Digital Commons <?=$page->title() ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Guides by Careful Digital" />
  <meta name="author" content="James Drever" />
  <!-- Fathom - beautiful, simple website analytics -->
  <script src="https://cdn.usefathom.com/script.js" data-site="PUGDMEZB" defer></script>
  <!-- / Fathom -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link href="/assets/css/custom.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
  </script>
  <?php if (true) : ?>
  <link rel="stylesheet" href="/css/lite-yt-embed.css" />
  <script src="/css/lite-yt-embed.js"></script>
  <?php endif ?>
</head>

<body>
  <header class="p-3 bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a href="https://careful.digital/" class="nav-link px-2 text-white"><img
            src="/assets/images/careful-digital-logo.svg" alt="Careful Digital logo: a circuit board heart" width="100"
            height="100">
          <br><a href="https://careful.digital/" class="nav-link px-2 text-white">CAREFUL DIGITAL</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item"></li><a href="/" class="nav-link px-2 text-white">The Digital Commons</a></li>
              <li class="nav-item"></li><a href="/guides/" class="nav-link px-2 text-white">Guides</a></li>
              <li class="nav-item"></li><a href="/resources/" class="nav-link px-2 text-white">Resources</a></li>
              <li class="nav-item"></li><a href="/blog/" class="nav-link px-2 text-white">Blog</a></li>
              <li class="nav-item"></li><a href="https://intentionaltechnology.substack.com" target="_blank"
                class="nav-link px-2 text-white">Intentional Technology Newsletter &rarr;</a></li>
            </ul>
          </div>
      </div>
    </nav>
  </header>
  <?php snippet('breadcrumb') ?> 