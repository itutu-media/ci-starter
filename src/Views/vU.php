<?= doctype(); ?>
<html lang="<?= session('setLang'); ?>">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($pageTitle) ? $pageTitle . ' - ' . getConfig('appName') : getConfig('appName'); ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="<?= base_url(); ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <?php if ($css) {
    foreach ($css as $css) {
      echo link_tag($css);
    }
  } ?>
  <?= link_tag('assets/plugins/global/plugins.bundle.min.css'); ?>
  <?= link_tag('assets/plugins/custom/prismjs/prismjs.bundle.min.css'); ?>
  <?= link_tag('assets/css/style.bundle.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/header/base/dark.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/header/menu/light.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/brand/dark.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/aside/dark.min.css'); ?>
  <?= link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
</head>

<body id="kt_body" class="page-loading">

  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
      <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <div class="content p-0 d-flex flex-column flex-column-fluid" id="kt_content">
          <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top" style="background-image: url('assets/media/bg/bg-5.jpg')">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center pt-25 pb-35">
                <h2 class="font-weight-bolder text-light mb-0">Computer Assisted Test</h2>
                <div class="d-flex">
                  <a href="/logout" class="h5 text-light font-weight-bold">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <div class="container mt-n15 gutter-b">
            <?= $this->renderSection('content') ?>
          </div>
        </div>
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">2020 ©</span>
              <a href="https://itutu-media.id/" target="_blank" class="text-dark-75 text-hover-primary">ITUTUMedia</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="general-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
          <button type="button" id="modal-ok-button" class="btn btn-danger font-weight-bold" data-action="" data-nya="">OK</button>
        </div>
      </div>
    </div>
  </div>
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24" />
          <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
          <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
        </g>
      </svg>
    </span>
  </div>

  <script>
    var HOST_URL = "<?= current_url(); ?>";
    var BASE_URL = "<?= base_url(); ?>";
  </script>

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
  <?= script_tag('assets/plugins/global/plugins.bundle.min.js'); ?>
  <?= script_tag('assets/plugins/custom/prismjs/prismjs.bundle.min.js'); ?>
  <?= script_tag('assets/js/scripts.bundle.min.js'); ?>
  <?= script_tag('assets/js/main.min.js'); ?>
  <?php if ($js) {
    foreach ($js as $js) {
      echo script_tag($js);
    }
  } ?>
</body>

</html>