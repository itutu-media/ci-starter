<?php

namespace IM\CI\Controllers;

use Config\Email;
use IM\CI\Controllers\GlobalController;
use Myth\Auth\Entities\User;

class AuthController extends GlobalController
{
	protected $auth;
	/**
	 * @var Auth
	 */
	protected $config;

	/**
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	public function __construct()
	{
		$this->session = service('session');

		$this->config = config('Auth');
		$this->auth = service('authentication');

		helper(['html', 'default', 'auth']);
	}

	public function login()
	{
		if ($this->auth->check()) {
			$redirectURL = session('redirect_url') ?? '/';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

		$_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? '/';

		$this->data['config'] = $this->config;
		$this->data['form']   = 'signin';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function attemptLogin()
	{
		if ($this->request->isAJAX()) {
			$rules = [
				'login'    => 'required',
				'password' => 'required',
			];
			if ($this->config->validFields == ['email']) {
				$rules['login'] .= '|valid_email';
			}

			if (!$this->validate($rules)) {
				$this->data = [
					'status'  => 401,
					'message' => $this->validator->getErrors(),
					'data'    => NULL
				];
				$this->render();
			}

			$login    = $this->request->getPost('login');
			$password = $this->request->getPost('password');
			$remember = (bool)$this->request->getPost('remember');

			$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

			if (!$this->auth->attempt([$type => $login, 'password' => $password], $remember)) {
				$this->data = [
					'status'  => 401,
					'message' => $this->auth->error() ?? lang('Login.badAttempt'),
					'data'    => NULL
				];
				$this->render();
			}

			if ($this->auth->user()->force_pass_reset === true) {
				$this->data = [
					'status' => 303,
					'message' => NULL,
					'data' => NULL,
					'redirect' => base_url('reset-password?token=' . $this->auth->user()->reset_hash)
				];
				$this->render();
			}

			$redirectURL = session('redirect_url') ?? '/';
			unset($_SESSION['redirect_url']);

			if (in_groups('DF'))
				$redirectURL = base_url('dashboard');
			else
				$redirectURL = base_url('support/dashboard');

			$user = user();
			$user->uid = encryptUrl($user->id);

			$this->data = [
				'status'   => 200,
				'message'  => lang('Login.success'),
				'data'     => $user,
				'redirect' => $redirectURL
			];
			$this->render();
		} else {
			return redirect()->route('login');
		}
	}

	public function logout()
	{
		if ($this->auth->check()) {
			$this->auth->logout();
		}

		return redirect()->to('/');
	}

	public function register()
	{
		if ($this->auth->check()) {
			return redirect()->back();
		}

		if (!$this->config->allowRegistration) {
			return redirect()->route('login')->with('error', lang('Register.disabled'));
		}

		$this->data['config'] = $this->config;
		$this->data['form']   = 'signup';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function attemptRegister()
	{
		if ($this->request->isAJAX()) {
			if (!$this->config->allowRegistration) {
				$this->data = [
					'status'  => 503,
					'message' => lang('Register.disabled'),
					'data'    => NULL
				];
				$this->render();
			}

			$users = model('UserModel');

			$rules = [
				'fullname'  => 'required',
				'username'  => 'required|alpha_numeric_space|min_length[6]|is_unique[users.username]',
				'email'     => 'required|valid_email|is_unique[users.email]',
				'password'  => 'required|min_length[8]',
				'cpassword' => 'required|matches[password]',
			];

			if (!$this->validate($rules)) {
				$this->data = [
					'status'  => 401,
					'message' => service('validation')->getErrors(),
					'data'    => NULL
				];
				$this->render();
			}

			$allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
			$user = new User($this->request->getPost($allowedPostFields));

			$this->config->requireActivation !== false ? $user->generateActivateHash() : $user->activate();

			if (!empty($this->config->defaultUserGroup)) {
				$users = $users->withGroup($this->config->defaultUserGroup);
			}

			if (!$users->save($user)) {
				$this->data = [
					'status'  => 500,
					'message' => $users->errors(),
					'data'    => NULL
				];
				$this->render();
			}

			$user = $users->where('email', $this->request->getPost('email'))->first();

			$userDetails = new \IM\CI\Models\App\M_userDetail();

			$userDetail = [
				'user_id'  => $user->id,
				'fullname' => $this->request->getPost('fullname')
			];

			$userDetails->tambah($userDetail);

			if ($this->config->requireActivation !== false) {
				$activator = service('activator');
				$sent = $activator->send($user);

				if (!$sent) {
					$this->data = [
						'status'   => 200,
						'message'  => $activator->error() ?? lang('Register.unknownError'),
						'data'     => NULL,
						'redirect' => base_url('register/' . encryptUrl($user->id))
					];
					$this->render();
				}

				$this->data = [
					'status'   => 200,
					'message'  => lang('Register.activationSent'),
					'data'     => NULL,
					'redirect' => base_url('register/' . encryptUrl($user->id))
				];
				$this->render();
			}

			$this->data = [
				'status'   => 200,
				'message'  => lang('Register.success'),
				'data'     => NULL,
				'redirect' => base_url('login')
			];
			$this->render();
		} else {
			return redirect()->route('register');
		}
	}

	public function registerSuccess($userId)
	{
		$users = model('UserModel');

		$user = $users->where('id', decryptUrl($userId))
			->where('active', 0)
			->first();

		if (is_null($user)) {
			return redirect()->route('login')->with('error', lang('Register.noUser'));
		}

		session()->setFlashdata('message', lang('Register.activationSent'));

		$this->data['config'] = $this->config;
		$this->data['user']   = $user;
		$this->data['form']   = 'resend';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function forgotPassword()
	{
		if ($this->config->activeResetter === false) {
			return redirect()->route('login')->with('error', lang('Forgot.disabled'));
		}

		$this->data['config'] = $this->config;
		$this->data['form']   = 'forgot';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function attemptForgot()
	{
		if ($this->request->isAJAX()) {
			if ($this->config->activeResetter === false) {
				echo json_encode(['status' => 503, 'message' => lang('Forgot.disabled'), 'data' => NULL]);
				die;
			}

			$users = model('UserModel');

			$user = $users->where('email', $this->request->getPost('email'))->first();

			if (is_null($user)) {
				echo json_encode(['status' => 500, 'message' => lang('Forgot.noUser'), 'data' => NULL]);
				die;
			}

			$user->generateResetHash();
			$users->save($user);

			$resetter = service('resetter');
			$sent = $resetter->send($user);

			if (!$sent) {
				echo json_encode(['status' => 500, 'message' => $resetter->error() ?? lang('Forgot.unknownError'), 'data' => NULL]);
				die;
			}

			echo json_encode(['status' => 200, 'message' => lang('Forgot.emailSent'), 'data' => NULL]);
			die;
		} else {
			return redirect()->route('login');
		}
	}

	public function resetPassword()
	{
		if ($this->config->activeResetter === false) {
			return redirect()->route('login')->with('error', lang('Forgot.disabled'));
		}

		$token = $this->request->getGet('token');

		$this->data['config'] = $this->config;
		$this->data['token']  = $token;
		$this->data['form']   = 'reset';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function attemptReset()
	{
		if ($this->config->activeResetter === false) {
			$this->data = [
				'status'  => 503,
				'message' => lang('Forgot.disabled'),
				'data'    => NULL
			];
			$this->render();
		}

		$users = model('UserModel');

		$users->logResetAttempt(
			$this->request->getPost('email'),
			$this->request->getPost('token'),
			$this->request->getIPAddress(),
			(string)$this->request->getUserAgent()
		);

		$rules = [
			'token'     => 'required',
			'email'     => 'required|valid_email',
			'password'  => 'required',
			'cpassword' => 'required|matches[password]',
		];

		if (!$this->validate($rules)) {
			$this->data = [
				'status'  => 401,
				'message' => $this->validator->getErrors(),
				'data'    => NULL
			];
			$this->render();
		}

		$user = $users->where('email', $this->request->getPost('email'))
			->where('reset_hash', $this->request->getPost('token'))
			->first();

		if (is_null($user)) {
			$this->data = [
				'status'  => 401,
				'message' => lang('Forgot.noUser'),
				'data'    => NULL
			];
			$this->render();
		}

		if (!empty($user->reset_expires) && time() > $user->reset_expires->getTimestamp()) {
			$this->data = [
				'status'  => 401,
				'message' => lang('Reset.tokenExpired'),
				'data'    => NULL
			];
			$this->render();
		}

		$user->password         = $this->request->getPost('password');
		$user->reset_hash       = null;
		$user->reset_at         = date('Y-m-d H:i:s');
		$user->reset_expires    = null;
		$user->force_pass_reset = false;
		$users->save($user);

		$this->data = [
			'status'  => 200,
			'message' => lang('Reset.success'),
			'data'    => NULL
		];
		$this->render();
	}

	public function activateAccount()
	{
		$users = model('UserModel');

		$users->logActivationAttempt(
			$this->request->getGet('token'),
			$this->request->getIPAddress(),
			(string) $this->request->getUserAgent()
		);

		$throttler = service('throttler');

		if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false) {
			return service('response')->setStatusCode(429)->setBody(lang('Register.tooManyRequests', [$throttler->getTokentime()]));
		}

		$user = $users->where('activate_hash', $this->request->getGet('token'))
			->where('active', 0)
			->first();

		if (is_null($user)) {
			session()->setFlashdata('error', lang('Register.noUser'));
		} else {
			$user->activate();

			$users->save($user);

			session()->setFlashdata('message', lang('Register.success'));
		}

		$this->data['config'] = $this->config;
		$this->data['user']   = $user;
		$this->data['form']   = 'signin';
		$this->data['js']     = [
			'assets/js/lang/login.' . $this->langSlug . '.min.js',
			'assets/js/login.min.js'
		];

		$this->render('IM\CI\Views\vL');
	}

	public function resendActivateAccount()
	{
		if ($this->request->isAJAX()) {
			if ($this->config->requireActivation === false) {
				$this->data = [
					'status'  => 503,
					'message' => lang('Register.disabled'),
					'data'    => NULL
				];
				$this->render();
			}

			$throttler = service('throttler');

			if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false) {
				$this->data = [
					'status'  => 429,
					'message' => lang('Register.tooManyRequests', [$throttler->getTokentime()]),
					'data'    => NULL
				];
				$this->render();
			}

			$login = urldecode($this->request->getGet('login'));
			$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

			$users = model('UserModel');

			$user = $users->where($type, $login)
				->where('active', 0)
				->first();

			if (is_null($user)) {
				$this->data = [
					'status'  => 401,
					'message' => lang('Register.noUser'),
					'data'    => NULL
				];
				$this->render();
			}

			$activator = service('activator');
			$sent = $activator->send($user);

			if (!$sent) {
				$this->data = [
					'status'  => 500,
					'message' => $activator->error() ?? lang('Register.unknownError'),
					'data'    => NULL
				];
				$this->render();
			}

			$this->data = [
				'status'  => 200,
				'message' => lang('Register.activationSent'),
				'data'    => NULL
			];
			$this->render();
		}
	}
}
