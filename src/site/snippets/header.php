<!doctype html>
<html lang="en-GB">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Natural Entrepeneurs platform: biomimicry for schools">
    <meta name="author" content="Careful Digital">
    <title>Natural Entrepreneurs: <?=$page->title()?></title>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
        <?php snippet('main-menu'); ?> 
  </header>

