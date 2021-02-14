<?= $this->extend('IM\CI\Views\vL') ?>

<?= $this->section('content') ?>
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
        <p class="login-message text-white py-2 mb-10" style="display:none"></p>
        <form class="form" id="kt_login_signup_form">
          <?= csrf_field(); ?>
          <input type="hidden" name="login" value="<?= isset($user) ? (is_object($user) ? $user->email : $user['email']) : ''; ?>" />
          <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button id="kt_login_signup_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"><?= lang('Register.resendButton'); ?></button>
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
<?= $this->endSection(); ?>