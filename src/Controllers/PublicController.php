<?php

namespace IM\CI\Controllers;

use IM\CI\Controllers\GlobalController;

class PublicController extends GlobalController
{

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		
		if (getConfig('publicMaintenance') === TRUE) {
			echo view('public/maintenance');
			exit;
		}
	}
}
