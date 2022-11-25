<!doctype html>
<html lang="en-GB">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Natural Entrepeneurs platform: biomimicry for schools">
    <meta name="author" content="Careful Digital">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?=url('/assets/css/custom.css')?>">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= url('/assets/css/lite-yt-embed.css')?>" />
    <script src="<?= url('/assets/css/lite-yt-embed.js')?>"></script>      
    <script>
      function getTranslation(content, uniqueId) {
        const translationElement = document.getElementById(uniqueId);
        fetch('https://api-free.deepl.com/v2/translate?auth_key=5a95e5a7-f770-f881-3b8f-982dc47f209f:fx&text=' + content + '&target_lang=EN')
          .then(response => response.json())
          .then(data => {
            translationElement.innerText = data.translations[0].text;
          });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel='stylesheet'
          id='mp-theme-css'
          href='https://natent.eu/wp-content/plugins/memberpress/css/ui/theme.css?ver=1.9.23'
          type='text/css'
          media='all'/>
    <link rel="icon"
          href="https://natent.eu/wp-content/uploads/2022/08/cropped-natent-favicon-32x32.jpg"
          sizes="32x32"/>
    <link rel="icon"
          href="https://natent.eu/wp-content/uploads/2022/08/cropped-natent-favicon-192x192.jpg"
          sizes="192x192"/>
    <link rel="apple-touch-icon"
          href="https://natent.eu/wp-content/uploads/2022/08/cropped-natent-favicon-180x180.jpg"/>
    <meta name="msapplication-TileImage"
          content="https://natent.eu/wp-content/uploads/2022/08/cropped-natent-favicon-270x270.jpg"/>
    <meta name='robots' content='max-image-preview:large'/>
  </head>
  <body style="background-color: #F8F5F4;">

  <header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <button class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="site-logo d-flex align-items-center col-md-3 mb-2 mb-md-0 text-decoration-none">
        <a href="/" class="d-flex align-items-center text-decoration-none">
          <img class="img-fluid m-1" src="<?=url('/assets/images/natent-logo.svg')?>" width="50"/>
          Natural
          <br>
          Entrepreneurs
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li>
            <a href="/" class="nav-link px-2">Home</a>
          </li>
          <li>
            <a href="#" class="nav-link px-2">About the Project</a>
          </li>
          <li>
            <a href="/for-teachers/" class="nav-link px-2">For Teachers</a>
          </li>
          <li>
            <a href="/for-students/" class="nav-link px-2">For Students</a>
          </li>
          <li>
            <a href="/platform/" class="nav-link px-2">The Platform</a>
          </li>
          <li>
            <a href="/contact/" class="nav-link px-2">Contact Us</a>
          </li>
        </ul>
        <div class="col-md-3 text-end">
          <select name="lang_choice_1" id="lang_choice_1">
            <option value="de">
              Deutsch
            </option>
            <option value="lv">
              Latviešu valoda
            </option>
            <option value="ro">
              Română
            </option>
            <option value="nl">
              Nederlands
            </option>
            <option value="en" selected='selected'>
              English
            </option>
            <option value="hu">
              Magyar
            </option>
          </select>
        </div>
      </div>
    </div>
  </nav>
</header>

