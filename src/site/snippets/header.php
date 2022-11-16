<!doctype html>
<html lang="en-GB">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Natural Entrepeneurs platform: biomimicry for schools">
    <meta name="author" content="Careful Digital">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <link rel="stylesheet"
          type="text/css"
          href="https://natent.eu/wp-content/themes/carefulcollab/css//mpcourses/classroom.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
      div.mpcs-progress-bar,
      div.mpcs-bookmark,
      div#mpcs-lesson-navigation {
        display: none;
      }
      
      .logo-list {
        padding: 20px 0;
        text-align: center;
        border-bottom: 1px solid #ddd;
      }
      
      .logo-list img {
        display: inline-block;
        max-width: 85%;
        padding: 15px 0;
        transition: all 0.3s ease-in-out;
      }
      
      .logo-list img:hover {
        filter: none;
        transform: scale(1.2);
        -webkit-filter: none;
        -moz-filter: none;
      }
      
      video {
        /* override other styles to make responsive */
        width: 100% !important;
        height: auto !important;
      }
    </style>
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YM5M48YTCY"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      
      gtag('config', 'G-YM5M48YTCY');
    </script>
    <script type="text/javascript">
      (function(c, l, a, r, i, t, y) {
        c[a] = c[a] || function() {
          (c[a].q = c[a].q || []).push(arguments)
        };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
      })(window, document, "clarity", "script", "cjfb1ymgzf");
    </script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel='stylesheet'
          id='mp-theme-css'
          href='https://natent.eu/wp-content/plugins/memberpress/css/ui/theme.css?ver=1.9.23'
          type='text/css'
          media='all'/>
    <link rel='stylesheet'
          id='wp-block-library-css'
          href='https://natent.eu/wp-includes/css/dist/block-library/style.min.css?ver=5.9.5'
          type='text/css'
          media='all'/>
    <style id='global-styles-inline-css' type='text/css'>
      body {
        --wp--preset--color--black: #000000;
        --wp--preset--color--cyan-bluish-gray: #abb8c3;
        --wp--preset--color--white: #ffffff;
        --wp--preset--color--pale-pink: #f78da7;
        --wp--preset--color--vivid-red: #cf2e2e;
        --wp--preset--color--luminous-vivid-orange: #ff6900;
        --wp--preset--color--luminous-vivid-amber: #fcb900;
        --wp--preset--color--light-green-cyan: #7bdcb5;
        --wp--preset--color--vivid-green-cyan: #00d084;
        --wp--preset--color--pale-cyan-blue: #8ed1fc;
        --wp--preset--color--vivid-cyan-blue: #0693e3;
        --wp--preset--color--vivid-purple: #9b51e0;
        --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
        --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
        --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
        --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
        --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
        --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
        --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
        --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
        --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
        --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
        --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
        --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
        --wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
        --wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
        --wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
        --wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
        --wp--preset--duotone--midnight: url('#wp-duotone-midnight');
        --wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
        --wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
        --wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
        --wp--preset--font-size--small: 13px;
        --wp--preset--font-size--medium: 20px;
        --wp--preset--font-size--large: 36px;
        --wp--preset--font-size--x-large: 42px;
      }
      
      .has-black-color {
        color: var(--wp--preset--color--black) !important;
      }
      
      .has-cyan-bluish-gray-color {
        color: var(--wp--preset--color--cyan-bluish-gray) !important;
      }
      
      .has-white-color {
        color: var(--wp--preset--color--white) !important;
      }
      
      .has-pale-pink-color {
        color: var(--wp--preset--color--pale-pink) !important;
      }
      
      .has-vivid-red-color {
        color: var(--wp--preset--color--vivid-red) !important;
      }
      
      .has-luminous-vivid-orange-color {
        color: var(--wp--preset--color--luminous-vivid-orange) !important;
      }
      
      .has-luminous-vivid-amber-color {
        color: var(--wp--preset--color--luminous-vivid-amber) !important;
      }
      
      .has-light-green-cyan-color {
        color: var(--wp--preset--color--light-green-cyan) !important;
      }
      
      .has-vivid-green-cyan-color {
        color: var(--wp--preset--color--vivid-green-cyan) !important;
      }
      
      .has-pale-cyan-blue-color {
        color: var(--wp--preset--color--pale-cyan-blue) !important;
      }
      
      .has-vivid-cyan-blue-color {
        color: var(--wp--preset--color--vivid-cyan-blue) !important;
      }
      
      .has-vivid-purple-color {
        color: var(--wp--preset--color--vivid-purple) !important;
      }
      
      .has-black-background-color {
        background-color: var(--wp--preset--color--black) !important;
      }
      
      .has-cyan-bluish-gray-background-color {
        background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
      }
      
      .has-white-background-color {
        background-color: var(--wp--preset--color--white) !important;
      }
      
      .has-pale-pink-background-color {
        background-color: var(--wp--preset--color--pale-pink) !important;
      }
      
      .has-vivid-red-background-color {
        background-color: var(--wp--preset--color--vivid-red) !important;
      }
      
      .has-luminous-vivid-orange-background-color {
        background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
      }
      
      .has-luminous-vivid-amber-background-color {
        background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
      }
      
      .has-light-green-cyan-background-color {
        background-color: var(--wp--preset--color--light-green-cyan) !important;
      }
      
      .has-vivid-green-cyan-background-color {
        background-color: var(--wp--preset--color--vivid-green-cyan) !important;
      }
      
      .has-pale-cyan-blue-background-color {
        background-color: var(--wp--preset--color--pale-cyan-blue) !important;
      }
      
      .has-vivid-cyan-blue-background-color {
        background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
      }
      
      .has-vivid-purple-background-color {
        background-color: var(--wp--preset--color--vivid-purple) !important;
      }
      
      .has-black-border-color {
        border-color: var(--wp--preset--color--black) !important;
      }
      
      .has-cyan-bluish-gray-border-color {
        border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
      }
      
      .has-white-border-color {
        border-color: var(--wp--preset--color--white) !important;
      }
      
      .has-pale-pink-border-color {
        border-color: var(--wp--preset--color--pale-pink) !important;
      }
      
      .has-vivid-red-border-color {
        border-color: var(--wp--preset--color--vivid-red) !important;
      }
      
      .has-luminous-vivid-orange-border-color {
        border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
      }
      
      .has-luminous-vivid-amber-border-color {
        border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
      }
      
      .has-light-green-cyan-border-color {
        border-color: var(--wp--preset--color--light-green-cyan) !important;
      }
      
      .has-vivid-green-cyan-border-color {
        border-color: var(--wp--preset--color--vivid-green-cyan) !important;
      }
      
      .has-pale-cyan-blue-border-color {
        border-color: var(--wp--preset--color--pale-cyan-blue) !important;
      }
      
      .has-vivid-cyan-blue-border-color {
        border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
      }
      
      .has-vivid-purple-border-color {
        border-color: var(--wp--preset--color--vivid-purple) !important;
      }
      
      .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
        background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
      }
      
      .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
        background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
      }
      
      .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
        background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
      }
      
      .has-luminous-vivid-orange-to-vivid-red-gradient-background {
        background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
      }
      
      .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
        background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
      }
      
      .has-cool-to-warm-spectrum-gradient-background {
        background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
      }
      
      .has-blush-light-purple-gradient-background {
        background: var(--wp--preset--gradient--blush-light-purple) !important;
      }
      
      .has-blush-bordeaux-gradient-background {
        background: var(--wp--preset--gradient--blush-bordeaux) !important;
      }
      
      .has-luminous-dusk-gradient-background {
        background: var(--wp--preset--gradient--luminous-dusk) !important;
      }
      
      .has-pale-ocean-gradient-background {
        background: var(--wp--preset--gradient--pale-ocean) !important;
      }
      
      .has-electric-grass-gradient-background {
        background: var(--wp--preset--gradient--electric-grass) !important;
      }
      
      .has-midnight-gradient-background {
        background: var(--wp--preset--gradient--midnight) !important;
      }
      
      .has-small-font-size {
        font-size: var(--wp--preset--font-size--small) !important;
      }
      
      .has-medium-font-size {
        font-size: var(--wp--preset--font-size--medium) !important;
      }
      
      .has-large-font-size {
        font-size: var(--wp--preset--font-size--large) !important;
      }
      
      .has-x-large-font-size {
        font-size: var(--wp--preset--font-size--x-large) !important;
      }
    </style>
    <link rel="https://api.w.org/" href="https://natent.eu/wp-json/"/>
    <link rel="alternate"
          type="application/json"
          href="https://natent.eu/wp-json/wp/v2/pages/115"/>
    <link rel="EditURI"
          type="application/rsd+xml"
          title="RSD"
          href="https://natent.eu/xmlrpc.php?rsd"/>
    <link rel="wlwmanifest"
          type="application/wlwmanifest+xml"
          href="https://natent.eu/wp-includes/wlwmanifest.xml"/>
    <meta name="generator" content="WordPress 5.9.5"/>
    <link rel="canonical" href="https://natent.eu/en/home/"/>
    <link rel='shortlink' href='https://natent.eu/'/>
    <link rel="alternate"
          type="application/json+oembed"
          href="https://natent.eu/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fnatent.eu%2Fen%2Fhome%2F"/>
    <link rel="alternate"
          type="text/xml+oembed"
          href="https://natent.eu/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fnatent.eu%2Fen%2Fhome%2F&#038;format=xml"/>
    <style type="text/css">
      .mpcs-classroom .nav-back i,
      .mpcs-classroom .navbar-section a.btn,
      .mpcs-classroom .navbar-section a,
      .mpcs-classroom .navbar-section button {
        color: rgba(255, 255, 255) !important;
      }
      
      .mpcs-classroom .navbar-section .dropdown .menu a {
        color: rgba(44, 54, 55) !important;
      }
      
      .mpcs-classroom .mpcs-progress-ring {
        background-color: rgba(29, 166, 154) !important;
      }
      
      .mpcs-classroom .mpcs-course-filter .dropdown .btn span,
      .mpcs-classroom .mpcs-course-filter .dropdown .btn i,
      .mpcs-classroom .mpcs-course-filter .input-group .input-group-btn,
      .mpcs-classroom .mpcs-course-filter .input-group .mpcs-search,
      .mpcs-classroom .mpcs-course-filter .input-group input[type=text],
      .mpcs-classroom .mpcs-course-filter .dropdown a,
      .mpcs-classroom .pagination,
      .mpcs-classroom .pagination i,
      .mpcs-classroom .pagination a {
        color: rgba(44, 54, 55) !important;
        border-color: rgba(44, 54, 55) !important;
      }
      
      /* body.mpcs-classroom a{
                                                                                                  color: rgba();
                                                                                                } */
      
      #mpcs-navbar,
      #mpcs-navbar button#previous_lesson_link,
      #mpcs-navbar button#previous_lesson_link:hover {
        background: rgba(44, 54, 55);
      }
      
      .course-progress .user-progress,
      .btn-green,
      #mpcs-navbar button:not(#previous_lesson_link) {
        background: rgba(29, 166, 154, 0.9);
      }
      
      .btn-green:hover,
      #mpcs-navbar button:not(#previous_lesson_link):focus,
      #mpcs-navbar button:not(#previous_lesson_link):hover {
        background: rgba(29, 166, 154);
      }
      
      .btn-green {
        border: rgba(29, 166, 154)
      }
      
      .course-progress .progress-text,
      .mpcs-lesson i.mpcs-circle-regular {
        color: rgba(29, 166, 154)
      }
      
      #mpcs-main #bookmark,
      .mpcs-lesson.current {
        background: rgba(29, 166, 154, 0.3)
      }
      
      .mpcs-instructor .tile-subtitle {
        color: rgba(29, 166, 154, 1)
      }
    </style>
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
    <link rel="alternate" href="https://natent.eu/de/home-3/" hreflang="de"/>
    <link rel="alternate" href="https://natent.eu/lv/home-2/" hreflang="lv"/>
    <link rel="alternate"
          href="https://natent.eu/ro/home-romana/"
          hreflang="ro"/>
    <link rel="alternate"
          href="https://natent.eu/nl/home-nederlands/"
          hreflang="nl"/>
    <link rel="alternate" href="https://natent.eu/en/home/" hreflang="en"/>
    <link rel="alternate"
          href="https://natent.eu/hu/home-magyar/"
          hreflang="hu"/>
    <link rel="alternate" href="https://natent.eu/" hreflang="x-default"/>
    <link rel='dns-prefetch' href='//s.w.org'/>
    <script type="text/javascript">
      window._wpemojiSettings = {
        "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/72x72\/",
        "ext": ".png",
        "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/13.1.0\/svg\/",
        "svgExt": ".svg",
        "source": {
          "concatemoji": "https:\/\/natent.eu\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.9.5"
        }
      };
      /*! This file is auto-generated */
      ! function(e, a, t) {
        var n, r, o, i = a.createElement("canvas"),
          p = i.getContext && i.getContext("2d");
      
        function s(e, t) {
          var a = String.fromCharCode;
          p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0);
          e = i.toDataURL();
          return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL()
        }
      
        function c(e) {
          var t = a.createElement("script");
          t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
        }
        for (o = Array("flag", "emoji"), t.supports = {
            everything: !0,
            everythingExceptFlag: !0
          }, r = 0; r < o.length; r++) t.supports[o[r]] = function(e) {
          if (!p || !p.fillText) return !1;
          switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
            case "flag":
              return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]);
            case "emoji":
              return !s([10084, 65039, 8205, 55357, 56613], [10084, 65039, 8203, 55357, 56613])
          }
          return !1
        }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
        t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function() {
          t.DOMReady = !0
        }, t.supports.everything || (n = function() {
          t.readyCallback()
        }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function() {
          "complete" === a.readyState && t.readyCallback()
        })), (n = t.source || {}).concatemoji ? c(n.concatemoji) : n.wpemoji && n.twemoji && (c(n.twemoji), c(n.wpemoji)))
      }(window, document, window._wpemojiSettings);
    </script>
    <style type="text/css">
      img.wp-smiley,
      img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 0.07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
      }
    </style>
  </head>
  <body style="background-color: #F8F5F4;">
    {% include "top-menu.njk" %}
