<?php

namespace IM\CI\Controllers;

use CodeIgniter\Controller;
use IM\CI\Libraries\IM_Message;
use IM\CI\Libraries\IM_MenuBuilder;
use IM\CI\Libraries\IM_Logger;

class GlobalController extends Controller
{
	protected $helpers	= ['default', 'html', 'cookie', 'auth'];
	protected $data			= [];
	protected $langs		= [];
	protected $langSlug = '';
	protected $defaultLang;

	protected $newData = [];
	protected $before  = [];
	protected $after   = [];

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->im_message  = new IM_Message();
		$this->menuBuilder = new IM_MenuBuilder();
		$this->im_logger   = new IM_Logger();

		$language = \Config\Services::language();
		$language->setLocale(session('setLang'));
		$this->defaultLang = config('App')->defaultLocale;
		$this->supportedLocales = config('App')->supportedLocales;

		$this->data['linkSlug'] = '';
		$this->langSlug = session('setLang');
		if (session('setLang') != $this->defaultLang) {
			$this->data['linkSlug'] = session('setLang') . '/';
		}

		$this->data['langSlug'] = $this->langSlug;

		$urlSegments = $this->request->uri->getSegments();
		if (count($urlSegments) > 0 && $urlSegments[0] == $this->langSlug)
			unset($urlSegments[0]);
		$alternateLink = implode('/', $urlSegments);

		$mLanguages = new \IM\CI\Models\App\M_languages();
		$availabelLanguages = $mLanguages->efektif()['rows'];
		if (isset($availabelLanguages)) {
			foreach ($availabelLanguages as $language) {
				$this->langs[$language['slug']] = [
					'id'             => $language['id'],
					'slug'           => $language['slug'],
					'name'           => $language['name'],
					'directory'      => $language['directory'],
					'code'           => $language['code'],
					'image'          => $language['image'],
					'alternate_link' => $language['slug'] . '/' . $alternateLink,
					'default'        => $language['default']
				];
			}
		}
		$this->data['langs'] = $this->langs;
	}

	protected function render($viewFile = NULL)
	{
		if ($viewFile === NULL && $this->request->isAJAX()) {
			header('Content-Type: application/json');
			echo json_encode($this->data);
			die;
		} else {

			$this->data['css'] = ($this->data['css']) ?? '';
			$this->data['js']  = ($this->data['js']) ?? '';

			echo view($viewFile, $this->data);
			die;
		}
	}

	protected function isAjaxReq($method = 'get', $redirect = NULL)
	{
		if ($this->request->isAJAX() && $this->request->getMethod() == $method)
			return true;

		if ($this->request->isAJAX())
			$this->ajaxResponse(FALSE, 'Page Not Found');
			
		if ($redirect)
			return redirect()->to($redirect);
		else
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	protected function ajaxResponse($status = TRUE, $message = 'Error', $data = NULL, $additional = [])
	{
		$this->data = [
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		];

		if ($additional)
			$this->data = array_merge($this->data, $additional);

		$this->render();
	}

	protected function doUpload($dir, $file, $fileName, $oldFile = NULL)
	{
		if (!file_exists($dir) && !is_dir($dir))
			mkdir($dir, 0777, TRUE);

		if (!is_null($oldFile) && file_exists($dir . $oldFile))
			unlink($dir . $oldFile);

		$file->move($dir, $fileName);

		return $file;
	}

	protected function checkEdit($fields, $oldData)
	{
		$postData = $this->request->getPost();

		if (!array_key_exists('active', $postData))
			$postData['active'] = '0';

		foreach ($fields as $key => $value) {
			if ($key == 'id')
				$postData[$key] = decryptUrl($postData[$key]);
			if ($postData[$key] != $oldData[$value]) {
				if ($key == 'id') {
					return FALSE;
				} else {
					$this->newData[$value] = $postData[$key];
					$this->before[$value] = $oldData[$value];
					$this->after[$value] = $postData[$key];
				}
			}
		}
	}

	public function notFound()
	{
		$segments = $this->request->uri->getSegments();
		if ($segments[0] == 'support') {
			$mMenu     = new \IM\CI\Models\Menu\M_menus();
			$sideBar   = $mMenu->getMenu('Admin Sidebar');

			$this->data['pageTitle']  = 'Error';
			$this->data['sidebar']    = $this->menuBuilder->adminSidebarBuilder($sideBar);
			$this->data['title']      = 'Not Found';
			$this->data['breadCrumb'] = ($this->data['breadCrumb']) ?? ['Dashboard' => 'support'];
			$this->data['messages']   = ($this->data['messages']) ?? $this->im_message->get();
			$this->render('IM\CI\Views\vA404');
		} else {
			$this->render('IM\CI\Views\vP404');
		}
	}

	public function comingSoon()
	{
		$segments = $this->request->uri->getSegments();
		if ($segments[0] == 'support') {
			$mMenu     = new \IM\CI\Models\Menu\M_menus();
			$sideBar   = $mMenu->getMenu('Admin Sidebar');

			$this->data['pageTitle']  = 'Coming Soon';
			$this->data['sidebar']    = $this->menuBuilder->adminSidebarBuilder($sideBar);
			$this->data['title']      = 'Coming Soon';
			$this->data['breadCrumb'] = ($this->data['breadCrumb']) ?? ['Dashboard' => 'support'];
			$this->data['messages']   = ($this->data['messages']) ?? $this->im_message->get();
			$this->render('IM\CI\Views\vAComingSoon');
		} else {
			$this->render('IM\CI\Views\vPComingSoon');
		}
	}

	public function changeLang()
	{
		$urlSegments = $this->request->uri->getSegments();
		if (in_array($urlSegments[0], $this->supportedLocales)) {
			session()->remove('setLang');
			session()->set('setLang', $urlSegments[0]);
		}
		return redirect()->to(previous_url());
	}
}
