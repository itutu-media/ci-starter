<?= doctype(); ?>
<html lang="<?= session('setLang'); ?>">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= getConfig('appName'); ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <?= link_tag('assets/css/login.css'); ?>
  <?= link_tag('assets/plugins/global/plugins.bundle.css'); ?>
  <?= link_tag('assets/plugins/custom/prismjs/prismjs.bundle.css'); ?>
  <?= link_tag('assets/css/style.bundle.min.css'); ?>
  <?= link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>

  <style>
    .error .error-title {
      font-size: 8.7rem !important;
    }

    @media (min-width: 768px) {
      .error .error-title {
        font-size: 15.7rem !important;
      }
    }
  </style>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

  <div class="d-flex flex-column flex-root">
    <div class="error d-flex flex-row-fluid bgi-size-cover bgi-position-center">
      <div class="d-flex flex-column flex-row-fluid text-center">
        <h1 class="error-title font-weight-boldest mb-12" style="margin-top: 12rem;">404</h1>
        <p class="display-4 font-weight-bold">Sorry we can't seem to find the page you're looking for.</p>
      </div>
    </div>
  </div>

  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };
  </script>

  <?= script_tag('assets/plugins/global/plugins.bundle.js'); ?>
  <?= script_tag('assets/plugins/custom/prismjs/prismjs.bundle.js'); ?>
  <?= script_tag('assets/js/scripts.bundle.min.js'); ?>
</body>

</html>