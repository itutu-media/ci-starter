<?= doctype(); ?>
<html lang="<?= session('setLang'); ?>">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= getConfig('appName'); ?></title>
  <?= csrf_meta(); ?>
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <?= link_tag('assets/css/login.min.css'); ?>
  <?= link_tag('assets/plugins/global/plugins.bundle.min.css'); ?>
  <?= link_tag('assets/plugins/custom/prismjs/prismjs.bundle.min.css'); ?>
  <?= link_tag('assets/css/style.bundle.min.css'); ?>
  <?= link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading bg-white">

  <div class="d-flex flex-column flex-root">

    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
      <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
        <div class="login-form text-center p-7 position-relative overflow-hidden">

          <div class="d-flex flex-center mb-15">
            <a href="#">
              <img src="<?= site_url('assets/media/logos/logo.png'); ?>" class="max-h-75px" alt="<?= getConfig('companyName'); ?>" />
            </a>
          </div>

          <div class="login-signin card">
            <div class="card-body border-secondary">
              <div class="overlay-wrapper">
                <div class="mb-10">
                  <h3><?= lang('Login.title'); ?></h3>
                  <div class="text-muted font-weight-bold"><?= lang('Login.subTitle'); ?></div>
                </div>
                <p class="login-message text-white py-2 mb-10" style="display:none"></p>
                <form class="form" id="kt_login_signin_form">
                  <?= csrf_field(); ?>
                  <div class="form-group mb-5">
                    <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Login.identity'); ?>" name="login" autocomplete="off" />
                  </div>
                  <div class="form-group mb-5">
                    <input class="form-control h-auto py-4 px-8" type="password" placeholder="<?= lang('Login.password'); ?>" name="password" />
                  </div>
                  <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                    <?php if ($config->allowRemembering) : ?>
                      <div class="checkbox-inline">
                        <label class="checkbox m-0 text-muted">
                          <input type="checkbox" name="remember" />
                          <span></span><?= lang('Login.rememberMe'); ?></label>
                      </div>
                    <?php endif; ?>
                    <?php if ($config->activeResetter) : ?>
                      <a href="javascript:;" id="kt_login_forgot"><?= lang('Login.forgotPassword'); ?></a>
                    <?php endif; ?>
                  </div>
                  <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"><?= lang('Login.button'); ?></button>
                </form>
                <?php if ($config->allowRegistration) : ?>
                  <div class="mt-10">
                    <span class="opacity-70 mr-4"><?= lang('Login.signUpText'); ?></span>
                    <a href="javascript:;" id="kt_login_signup" class="font-weight-bold"><?= lang('Login.signUp'); ?></a>
                  </div>
                <?php endif; ?>
                <div class="overlay-layer bg-dark-o-10" style="display: none;">
                  <div class="spinner spinner-primary"></div>
                </div>
              </div>
            </div>
          </div>

          <?php if ($config->allowRegistration) : ?>
            <div class="login-signup card">
              <div class="card-body border-secondary">
                <div class="overlay-wrapper">
                  <div class="mb-10">
                    <h3><?= lang('Register.title'); ?></h3>
                    <div class="text-muted font-weight-bold"><?= lang('Register.subTitle'); ?></div>
                  </div>
                  <p class="login-message text-white py-2 mb-10" style="display:none"></p>
                  <form class="form" id="kt_login_signup_form">
                    <?= csrf_field(); ?>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Register.fullName'); ?>" name="fullname" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Register.email'); ?>" name="email" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Register.username'); ?>" name="username" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="password" placeholder="<?= lang('Register.password'); ?>" name="password" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="password" placeholder="<?= lang('Register.confirmPassword'); ?>" name="cpassword" />
                    </div>
                    <div class="form-group mb-5 text-left">
                      <div class="checkbox-inline">
                        <label class="checkbox m-0">
                          <input type="checkbox" name="agree" />
                          <span></span><?= lang('Register.agree'); ?>
                          <a href="#" class="font-weight-bold ml-1"><?= lang('Register.terms'); ?></a>.</label>
                      </div>
                      <div class="form-text text-muted text-center"></div>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                      <button id="kt_login_signup_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"><?= lang('Register.buttonSignUp'); ?></button>
                      <button id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2"><?= lang('Register.buttonCancel'); ?></button>
                    </div>
                  </form>
                  <div class="overlay-layer bg-dark-o-10" style="display: none;">
                    <div class="spinner spinner-primary"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($config->activeResetter) : ?>
            <div class="login-forgot card">
              <div class="card-body border-secondary">
                <div class="overlay-wrapper">
                  <div class="mb-10">
                    <h3><?= lang('Forgot.title'); ?></h3>
                    <div class="text-muted font-weight-bold"><?= lang('Forgot.subTitle'); ?></div>
                  </div>
                  <p class="login-message text-white py-2 mb-10" style="display:none"></p>
                  <form class="form" id="kt_login_forgot_form">
                    <div class="form-group mb-10">
                      <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Forgot.email'); ?>" name="email" autocomplete="off" />
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                      <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"><?= lang('Forgot.buttonSubmit'); ?></button>
                      <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2"><?= lang('Forgot.buttonCancel'); ?></button>
                    </div>
                  </form>
                  <div class="overlay-layer bg-dark-o-10" style="display: none;">
                    <div class="spinner spinner-primary"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($config->allowRegistration) : ?>
            <div class="login-resend card">
              <div class="card-body border-secondary">
                <div class="overlay-wrapper">
                  <p class="login-message text-white py-2 mb-10" style="display:none"></p>
                  <form class="form" id="kt_login_resend_form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="login" value="<?= isset($user) ? (is_object($user) ? $user->email : $user['email']) : ''; ?>" />
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                      <button id="kt_login_resend_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"><?= lang('Register.resendButton'); ?></button>
                    </div>
                  </form>
                  <div class="overlay-layer bg-dark-o-10" style="display: none;">
                    <div class="spinner spinner-primary"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($config->activeResetter) : ?>
            <div class="login-reset card">
              <div class="card-body border-secondary">
                <div class="overlay-wrapper">
                  <div class="mb-10">
                    <h3><?= lang('Reset.title'); ?></h3>
                    <div class="text-muted font-weight-bold"><?= lang('Reset.subTitle'); ?></div>
                  </div>
                  <p class="login-message text-white py-2 mb-10" style="display:none"></p>
                  <form class="form" id="kt_login_reset_form">
                    <?= csrf_field(); ?>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="hidden" placeholder="<?= lang('Reset.token'); ?>" name="token" autocomplete="off" value="<?= isset($token) ? $token : ''; ?>" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="text" placeholder="<?= lang('Reset.email'); ?>" name="email" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="password" placeholder="<?= lang('Reset.password'); ?>" name="password" />
                    </div>
                    <div class="form-group mb-5">
                      <input class="form-control h-auto py-4 px-8" type="password" placeholder="<?= lang('Reset.confirmPassword'); ?>" name="cpassword" />
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                      <button id="kt_login_reset_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"><?= lang('Reset.buttonSubmit'); ?></button>
                    </div>
                  </form>
                  <div class="overlay-layer bg-dark-o-10" style="display: none;">
                    <div class="spinner spinner-primary"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

  </div>

  <?php
  if (isset($langs) && count($langs) > 1) :
  ?>
    <div class="d-flex flex-center mb-5">
      <div class="nav nav-dark">
        <?php
        foreach ($langs as $key => $lang) :
          echo '<a href="' . site_url($lang['alternate_link']) . '" class="pl-0 pr-5">' . $lang['name'] . '</a>';
        endforeach;
        ?>
      </div>
    </div>
  <?php
  endif;
  ?>

  <script>
    var HOST_URL = "<?= base_url(); ?>";
    var FORM = "<?= $form; ?>";
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
  <?php if ($js) {
    foreach ($js as $js) {
      echo script_tag($js);
    }
  } ?>
  <script>
    message = '<?= session()->has('message') ? session('message') : (session()->has('error') ? session('error') : ''); ?>';
    status = '<?= session()->has('message') ? 'success' : (session()->has('error') ? 'danger' : ''); ?>';
    if (message != '') {
      setTimeout(function() {
        showMessage(message, status);
      }, 1000);
    }
  </script>
</body>

</html>