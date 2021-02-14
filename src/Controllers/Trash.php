<?php

namespace IM\CI\Controllers;

use App\Models\M_dimensions;
use \IM\CI\Controllers\AdminController;
use \App\Models\M_methods;
use App\Models\M_questions;

class Trash extends AdminController
{
	protected $module = 'trash';

	public function __construct()
	{
		if (!in_groups(['IM', 'SA']))
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	public function index()
	{
		helper(['form']);
		$forms['name'] = [
			'type'     => 'input',
			'label'    => 'Name',
			'name'     => 'name',
			'field'    => [
				'class' => 'form-control filter-input',
				'name'  => 'name',
			]
		];
		$forms['module'] = [
			'type'     => 'dropdown',
			'label'    => 'Module',
			'name'     => 'module',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'module',
				'options' => [
					''          => 'All',
					'metode'    => 'Metode',
					'dimensi'   => 'Dimensi',
					'bank-soal' => 'Bank Soal',
					'test'      => 'Test',
					'hasil-tes' => 'Hasil Tes',
					'clients'   => 'Client'
				],
			]
		];

		$this->data['forms']      = $forms;
		$this->data['js']         = [
			'assets/js/' . $this->module . '/data.min.js'
		];
		$this->data['pageTitle']  = 'Trash';
		$this->data['title']      = 'Trash';
		$this->data['subTitle']   = '';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Trash' => ''];
		$this->data['table']      = 'table_'.$this->module;
		$this->render('IM\CI\Views\support\\' . $this->module);
	}

	public function list()
	{
		if ($this->request->isAJAX()) {
			$pagination = $this->request->getPost('pagination');
			$query      = $this->request->getPost('query');
			$sort       = $this->request->getPost('sort');
			$perpage    = ($pagination['perpage']) ?? 10;
			$page       = ($pagination['page']) ?? 1;
			$field      = ($sort['field']) ?? 'id';
			$sort       = ($sort['sort']) ?? 'asc';
			$offset     = $perpage * ($page - 1);

			$params = [
				'limit' => [
					'perpage' => $perpage,
					'page'    => $offset,
				],
				// 'order' => [
				// 	[$field, $sort],
				// ],
			];

			$module = '';
			if (isset($query['multiple'])) {
				$filters = json_decode($query['multiple'], true);
				$where = [];
				foreach ($filters as $key => $filter) {
					if ($key != 'module')
						$where[] = [$key, $filter, 'AND'];
					else
						$module = $filter;
				}
				$params['where'] = $where;
			}

			if (isset($query['keyword'])) {
				$params['groupLike'] = [
					['name', $query['keyword'], 'AND'],
					['module', $query['keyword'], 'OR']
				];
			}

			$mMethdos = new M_methods();
			$params['select'] = "id, name, 'methods' module";
			$methods  = $mMethdos->sampah($params);

			$mDimensions = new M_dimensions();
			$params['select'] = "a.id, a.name, 'dimensions' module";
			$dimensions  = $mDimensions->sampah($params);

			$mQuestions = new M_questions();
			$params['select'] = "a.id, question name, 'questions' module";
			$questions  = $mQuestions->sampah($params);
			
			if ($module == 'methods')
				$allData = $methods['rows'];
			else if ($module == 'dimensions')
				$allData = $dimensions['rows'];
			else if ($module == 'questions')
				$allData = $questions['rows'];
			else
				$allData = array_merge($methods['rows'], $dimensions['rows'], $questions['rows']);
			$total = count($allData);

			foreach ($allData as $index => $row) {
				$allData[$index]['id'] = encryptUrl($row['id']);
			}

			$pages = $total / $perpage;
			$this->data = [
				'meta' => [
					'page'    => $page,
					'pages'   => ceil($pages),
					'perpage' => $perpage,
					'total'   => $total,
					'sort'    => $sort,
					'field'   => $field
				],
				'data' => $allData
			];
			$this->render();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	public function detail($id)
	{
		$id   = decryptUrl($id);
		$data = $this->im_logger->getById($id);

		$this->data = [
			'status'  => ($data) ? TRUE : FALSE,
			'message' => ($data) ? 'Data ditemukan' : 'Data tidak ditemukan',
			'data'    => ($data) ? encryptUrl($data['id']) : '',
			'detail'  => ($data) ? view('IM\CI\Views\vAModalDetail', ['data' => $data]) : ''
		];
		if ($this->request->isAJAX()) {
			$this->render();
		}
	}
}
