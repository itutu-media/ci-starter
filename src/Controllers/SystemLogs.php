<?php

namespace IM\CI\Controllers;

use \IM\CI\Controllers\AdminController;

class SystemLogs extends AdminController
{
	protected $module = 'system-logs';

	public function __construct()
	{
		if (!in_groups(['IM', 'SA']))
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	public function index()
	{
		helper(['form']);
		$forms['date'] = [
			'type'     => 'input',
			'label'    => 'Date',
			'name'     => 'date',
			'field'    => [
				'class' => 'form-control filter-input datepicker',
				'name'  => 'date',
			]
		];
		$forms['user'] = [
			'type'     => 'input',
			'label'    => 'User',
			'name'     => 'user',
			'field'    => [
				'class' => 'form-control filter-input',
				'name'  => 'user',
			]
		];
		$forms['action'] = [
			'type'     => 'dropdown',
			'label'    => 'Action',
			'name'     => 'action',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'action',
				'options' => [
					''        => 'All',
					'create'  => 'Create',
					'update'  => 'Update',
					'delete'  => 'Delete',
					'restore' => 'Restore',
				],
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
					''           => 'All',
					'methods'    => 'Methods',
					'dimensions' => 'Dimensions',
					'questions'  => 'Questions',
					'tests'      => 'Tests',
					'results'    => 'Test Results',
					'clients'    => 'Clients',
				],
			]
		];
		$forms['status'] = [
			'type'     => 'dropdown',
			'label'    => 'Status',
			'name'     => 'status',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'status',
				'options' => [
					''  => 'All',
					'0' => 'Failed',
					'1' => 'Success'
				],
			]
		];

		$this->data['forms']      = $forms;
		$this->data['js']         = [
			'assets/js/' . $this->module . '/data.min.js'
		];
		$this->data['pageTitle']  = 'System Logs';
		$this->data['title']      = 'System Logs';
		$this->data['subTitle']   = '';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'System Logs' => ''];
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
			$field      = ($sort['field']) ?? '_logs.id';
			$sort       = ($sort['sort']) ?? 'desc';
			$offset     = $perpage * ($page - 1);

			$params = [
				'limit' => [
					'perpage' => $perpage,
					'page'    => $offset,
				],
				'order' => [
					[$field, $sort],
				],
			];

			if (isset($query['multiple'])) {
				$filters = json_decode($query['multiple'], true);
				foreach ($filters as $key => $filter) {
					$this->im_logger->{$key}($filter);
				}
			}

			if (isset($query['keyword'])) {
				$params['groupLike'] = [
					['name', $query['keyword'], 'AND'],
					['description', $query['keyword'], 'OR']
				];
			}

			$data  = $this->im_logger->orderBy($params['order'][0])->get('array', $perpage, $page);
			$total = $data['total'];
			$data  = $data['rows'];

			foreach ($data as $index => $row) {
				$data[$index]['id'] = encryptUrl($row['id']);
				$data[$index]['user_id'] = encryptUrl($row['user_id']);
			}

			$pages = $total / $perpage;
			$this->data = [
				'meta' => [
					'page'    => $page,
					'pages'   => ceil($pages),
					'perpage' => $perpage,
					'total'   => $total,
					'sort'    => $sort,
					'field'   => $field,
				],
				'data' => $data,
				'query'=> $this->im_logger->lastQuery()
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
