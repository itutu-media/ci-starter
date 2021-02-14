<?php

namespace IM\CI\Controllers;

use \IM\CI\Controllers\AdminController;

class Groups extends AdminController
{
	protected $module = 'groups';

	public function __construct()
	{
		if (!in_groups(['IM', 'SA']) && !has_permission($this->module))
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		$this->model  = new \IM\CI\Models\App\M_groups();
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
		$forms['description'] = [
			'type'     => 'input',
			'label'    => 'Description',
			'name'     => 'description',
			'field'    => [
				'class' => 'form-control filter-input',
				'name'  => 'description',
			]
		];
		$forms['manage'] = [
			'type'     => 'dropdown',
			'label'    => 'Status',
			'name'     => 'manage',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'manage',
				'options' => [
					''  => 'All',
					'0' => 'Not Manage',
					'1' => 'Manage'
				],
			]
		];

		$this->data['forms']      = $forms;
		$this->data['js']         = [
			'assets/js/' . $this->module . '/data.min.js'
		];
		$this->data['pageTitle']  = 'Groups';
		$this->data['title']      = 'Data Groups';
		$this->data['subTitle']   = '';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Groups' => ''];
		$this->data['module']     = $this->module;
		$this->render('\IM\CI\Views\vAList');
	}

	public function list()
	{
		if ($this->request->isAJAX()) {
			$pagination = $this->request->getPost('pagination');
			$query      = $this->request->getPost('query');
			$sort       = $this->request->getPost('sort');
			$perpage    = ($pagination['perpage']) ?? 10;
			$page       = ($pagination['page']) ?? 1;
			$field      = ($sort['field']) ?? 'no';
			$sort       = ($sort['sort']) ?? 'asc';
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
				$where = [];
				$fields = [
					'name'        => 'name',
					'description' => 'description',
					'manage'      => 'manage'
				];
				$filters = json_decode($query['multiple'], true);
				foreach ($filters as $key => $filter) {
					$where[] = [$fields[$key], $filter, 'AND'];
				}
				$params['where'] = $where;
			}

			if (isset($query['keyword'])) {
				$params['groupLike'] = [
					['name', $query['keyword'], 'AND'],
					['description', $query['keyword'], 'OR']
				];
			}

			$data  = $this->model->semua($params);
			$total = $data['total'];

			foreach ($data['rows'] as $index => $row) {
				$data['rows'][$index]['no'] = encryptUrl($row['no']);
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
				'data' => $data['rows'],
				'query' => (string) $this->model->getLastQuery()
			];
			$this->render();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	private function _form($params = [], $validation = null)
	{
		helper(['form', 'text']);
		$i = 0;
		$forms = [];
		$forms['id'] = [
			'type'  => 'hidden',
			'name'  => 'id',
			'field' => [
				'id' => (isset($params['id'])) ? encryptUrl($params['id']) : ''
			]
		];
		$forms['name'] = [
			'type'     => 'input',
			'required' => 'required',
			'label'    => 'Name',
			'name'     => 'name',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('name') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'name',
				'id'          => 'name',
				'placeholder' => 'Ex. GR',
				'value'       => set_value('name', ($params['name']) ?? ''),
				'maxlength'   => '2',
				'tabindex'    => ++$i,
				'autofocus'   => 'true'
			]
		];
		$forms['description'] = [
			'type'     => 'input',
			'required' => 'required',
			'label'    => 'Description',
			'name'     => 'description',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('description') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'description',
				'id'          => 'description',
				'placeholder' => 'Ex. Group 1',
				'value'       => set_value('description', ($params['description']) ?? ''),
				'maxlength'   => '255',
				'tabindex'    => ++$i,
			]
		];
		$forms['manage'] = [
			'type'  => 'switch',
			'label' => 'Manage',
			'name'  => 'manage',
			'style' => 'primary',
			'fields' => [[
				'name'     => 'manage',
				'id'       => 'manage',
				'value'    => '1',
				'tabindex' => ++$i,
			]]
		];

		if ((isset($params['manage']) && $params['manage'] == 1) || empty($params))
			$forms['manage']['fields'][0]['checked'] = 'checked';

		$this->data['form_open'] = ['class' => 'form', 'id' => 'kt_form'];
		$this->data['btnSubmit'] = [
			'type'     => 'submit',
			'class'    => 'btn btn-primary font-weight-bolder',
			'content'  => '<i class="ki ki-check icon-sm"></i>Save Form</button>',
			'tabindex' => ++$i,
		];
		$this->data['btnReset'] = [
			'type'     => 'reset',
			'class'    => 'btn btn-dark font-weight-bolder',
			'content'  => '<i class="ki ki-round icon-sm"></i>Reset Form</button>',
			'tabindex' => ++$i,
		];
		return $forms;
	}

	public function create()
	{
		if ($this->validate([
			'name'        => 'required',
			'description' => 'required',
		])) {
			$data = $this->request->getPost();
			if ($this->request->getMethod() == 'post' && $newID = $this->model->insert($data)) {
				$this->im_message->add('success', "Data berhasil disimpan");
				$this->im_logger->action('create')->module($this->module)->moduleId($newID)->status('1')->log();
				return redirect()->to('/support/' . $this->module);
			} else {
				$this->im_logger->action('create')->module($this->module)->moduleId($newID)->status('0')->log();
				$this->im_message->add('danger', "Terjadi kesalahan saat menyimpan data");
			}
		} else {
			if ($this->request->getMethod() == 'post')
				$validation = \Config\Services::validation();
			else
				$validation = null;
		}

		$this->data['pageTitle']  = 'Groups';
		$this->data['title']      = 'Create Groups';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Groups' => $this->module, 'Create' => 'create'];

		$this->data['forms'] = $this->_form([], $validation);
		$this->data['js']    = ['assets/js/' . $this->module . '/form.min.js'];
		$this->render('IM\CI\Views\vAForm');
	}

	private function _getDetail($id)
	{
		return $this->model->baris($id, ['select' => 'id, name, description, manage']);
	}

	public function edit($id)
	{
		$id = decryptUrl($id);
		$data = $this->_getDetail($id);

		if (is_null($data)) {
			$this->im_message->add('danger', "Data tidak ditemukan");
			return redirect()->to('/support/' . $this->module);
		}

		if ($this->validate([
			'name'          => 'required',
			'description'   => 'required',
		])) {
			$before = $after = [];
			$fields = [
				'id'          => 'id',
				'name'        => 'name',
				'description' => 'description',
				'manage'      => 'manage'
			];
			$postData = $this->request->getPost();
			if (!array_key_exists('manage', $postData))
				$postData['manage'] = '0';
			foreach ($fields as $key => $value) {
				if ($key == 'id')
					$postData[$key] = decryptUrl($postData[$key]);
				if ($postData[$key] != $data[$value]) {
					if ($key == 'id') {
						$this->im_message->add('info', "ID tidak sesuai");
						return redirect()->to('/support/' . $this->module);
					} else {
						$newData[$value] = $postData[$key];
						$before[$value] = $data[$value];
						$after[$value] = $postData[$key];
					}
				}
			}
			if ($before) {
				if ($this->request->getMethod() == 'post' && $this->model->update($id, $newData)) {
					$this->im_message->add('success', "Data berhasil diperbarui");
					$this->im_logger->action('update')->module($this->module)->moduleId($id)->note(json_encode(['b' => $before, 'a' => $after]))->status('1')->log();
					return redirect()->to('/support/' . $this->module);
				} else {
					$this->im_logger->action('update')->module($this->module)->moduleId($id)->note(json_encode(['b' => $before, 'a' => $after]))->status('0')->log();
					$this->im_message->add('danger', "Terjadi kesalahan saat menyimpan data");
				}
			} else {
				$this->im_message->add('info', "Tidak ada perubahan data");
				return redirect()->to('/support/' . $this->module);
			}
		} else {
			if ($this->request->getMethod() == 'post')
				$validation = \Config\Services::validation();
			else
				$validation = null;
		}

		$this->data['pageTitle']  = 'Methods';
		$this->data['title']      = 'Edit Methods';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Methods' => $this->module, 'Edit' => 'edit'];

		$this->data['forms'] = $this->_form($data, $validation);
		$this->data['js']    = ['assets/js/' . $this->module . '/form.min.js'];
		$this->render('IM\CI\Views\vAForm');
	}

	public function detail($id)
	{
		$id   = decryptUrl($id);
		$data = $this->_getDetail($id);

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

	public function delete($id)
	{
		if ($this->request->getMethod() == 'get' && $this->request->isAJAX()) {
			$id   = decryptUrl($id);
			$data = $this->_getDetail($id);

			$this->data = [
				'status'  => ($data) ? TRUE : FALSE,
				'message' => ($data) ? 'Data ditemukan' : 'Data tidak ditemukan',
				'data'    => ($data) ? encryptUrl($data['id']) : '',
				'detail'  => ($data) ? view('IM\CI\Views\vAModalDelete', ['data' => $data, 'softDelete' => method_exists($this, 'restore')]) : ''
			];
			$this->render();
		}
		if ($this->request->getMethod() == 'delete' && $this->request->isAJAX()) {
			$id   = decryptUrl($id);
			$data = $this->model->find($id);

			if ($data) {
				$delete = $this->model->delete($id);

				if ($delete)
					$this->im_logger->action('delete')->module($this->module)->moduleId($id)->note($data)->status('1')->log();
				else
					$this->im_logger->action('delete')->module($this->module)->moduleId($id)->status('0')->log();

				$this->data = [
					'status'  => ($delete) ? TRUE : FALSE,
					'message' => ($delete) ? 'Data berhasil dihapus' : 'Data gagal dihapus',
					'data'    => $data
				];
			} else {
				$this->data = [
					'status'  => FALSE,
					'message' => 'Data tidak ditemukan',
					'data'    => NULL
				];
			}
			$this->render();
		}
	}
}
