<?php

namespace IM\CI\Controllers;

use \IM\CI\Controllers\AdminController;
use Myth\Auth\Entities\User;

class Users extends AdminController
{
	public function __construct()
	{
		if(!in_groups(['IM', 'SA']))
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		$this->config = config('Auth');
		$this->model  = new \IM\CI\Models\App\M_userDetail();
	}

	public function index()
	{
		helper(['form']);
		$forms['name'] = [
			'type'     => 'input',
			'label'    => 'Full Name',
			'name'     => 'fullname',
			'field'    => [
				'class' => 'form-control filter-input',
				'name'  => 'fullname',
			]
		];
		$forms['role'] = [
			'type'     => 'dropdown',
			'label'    => 'Role',
			'name'     => 'group_id',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'group_id',
				'options' => [
					''  => 'All',
					'2' => 'Super Admin',
					'3' => 'Admin'
				],
			]
		];
		$forms['active'] = [
			'type'     => 'dropdown',
			'label'    => 'Status',
			'name'     => 'active',
			'field'    => [
				'class'   => 'form-control filter-input',
				'name'    => 'active',
				'options' => [
					''  => 'All',
					'0' => 'Tidak Aktif',
					'1' => 'Aktif'
				],
			]
		];

		$this->data['forms']      = $forms;
		$this->data['js']         = [
			'assets/js/users/data.js'
		];
		$this->data['pageTitle']  = 'Users';
		$this->data['title']      = 'Data Users';
		$this->data['subTitle']   = 'Data admin';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Users' => ''];
		$this->render('IM\CI\Views\support\users');
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
				$filters = json_decode($query['multiple'], true);
				$where = [];
				foreach ($filters as $key => $filter) {
					$where[] = [$key, $filter, 'AND'];
				}
				$params['where'] = $where;
			}

			if (isset($query['keyword'])) {
				$params['groupLike'] = [
					['fullname', $query['keyword'], 'AND'],
					['d.description', $query['keyword'], 'OR']
				];
			}

			$data  = $this->model->eksis($params);
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
				'data' => $data['rows']
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
			'type' => 'hidden',
			'name' => 'id',
			'field' => [
				'id' => (isset($params['id'])) ? encryptUrl($params['id']) : ''
			]
		];
		$forms['name'] = [
			'type'     => 'input',
			'required' => 'required',
			'label'    => 'Full Name',
			'name'     => 'fullname',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('fullname') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'fullname',
				'id'          => 'fullname',
				'placeholder' => 'Ex. John Doe',
				'value'       => set_value('fullname', ($params['name']) ?? ''),
				'maxlength'   => '50',
				'tabindex'    => ++$i,
				'autofocus'   => 'true'
			]
		];
		$forms['address'] = [
			'type'     => 'textarea',
			'required' => 'required',
			'label'    => 'Address',
			'name'     => 'address',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('address') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'address',
				'id'          => 'address',
				'placeholder' => 'Ex. Main Street, YK, INA',
				'value'       => set_value('address', ($params['address']) ?? ''),
				'tabindex'    => ++$i,
				'rows'        => '2'
			]
		];
		$forms['phone'] = [
			'type'     => 'input',
			'required' => 'required',
			'label'    => 'Phone',
			'name'     => 'phone',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('phone') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'phone',
				'id'          => 'phone',
				'placeholder' => 'Ex. 08123456789',
				'value'       => set_value('phone', ($params['phone']) ?? ''),
				'maxlength'   => '15',
				'tabindex'    => ++$i,
			]
		];
		$forms['email'] = [
			'type'     => 'email',
			'required' => 'required',
			'label'    => 'Email',
			'name'     => 'email',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('email') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'email',
				'id'          => 'email',
				'placeholder' => 'Ex. john.doe@mail.com',
				'value'       => set_value('email', ($params['email']) ?? ''),
				'maxlength'   => '255',
				'tabindex'    => ++$i,
			]
		];
		$forms['username'] = [
			'type'     => 'input',
			'required' => 'required',
			'label'    => 'Username',
			'name'     => 'username',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('username') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'username',
				'id'          => 'username',
				'placeholder' => 'Ex. johndoe',
				'value'       => set_value('username', ($params['username']) ?? ''),
				'maxlength'   => '30',
				'tabindex'    => ++$i,
			]
		];
		$forms['password'] = [
			'type'     => 'password',
			'required' => 'required',
			'label'    => 'Password',
			'name'     => 'password',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('password') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'password',
				'id'          => 'password',
				'placeholder' => 'Ex. Strong Password',
				'value'       => set_value('password', ($params['password']) ?? ''),
				'minlength'   => '8',
				'maxlength'   => '32',
				'tabindex'    => ++$i,
			]
		];
		$forms['cpassword'] = [
			'type'     => 'password',
			'required' => 'required',
			'label'    => 'Confirm Password',
			'name'     => 'cpassword',
			'field'    => [
				'class'       => (isset($validation)) ? ($validation->hasError('cpassword') ? 'form-control is-invalid' : 'form-control is-valid') : 'form-control',
				'name'        => 'cpassword',
				'id'          => 'cpassword',
				'placeholder' => 'Ex. Strong cPassword',
				'value'       => set_value('cpassword', ($params['cpassword']) ?? ''),
				'minlength'   => '8',
				'maxlength'   => '32',
				'tabindex'    => ++$i,
			]
		];

		$mGroups   = new \IM\CI\Models\App\M_authGroups();
		$groups    = $mGroups->where(['id >' => 1, 'manage' => 1])->findAll();
		$optGroups = [];
		$j         = 0;
		$selectedGroups = [];
		if (isset($params['groups'])) {
			$selectedGroups = explode(',', $params['groups']);
		}

		foreach ($groups as $key => $value) {
			$optGroups[$j] = [
				'name'     => 'groups',
				'text'     => $value['name'] . ' - ' . $value['description'],
				'value'    => $value['id'],
				'tabindex' => ++$i
			];
			if (in_array($value['id'], $selectedGroups))
				$optGroups[$j]['checked'] = 'checked';
			$j++;
		}

		$forms['groups'] = [
			'type'   => 'checkbox',
			'style'  => 'list',
			'label'  => 'Groups',
			'name'   => 'groups',
			'fields' => $optGroups
		];

		$forms['active'] = [
			'type'  => 'switch',
			'label' => 'Active',
			'name'  => 'active',
			'style' => 'primary',
			'fields' => [[
				'name'     => 'active',
				'id'       => 'active',
				'value'    => '1',
				'tabindex' => ++$i,
			]]
		];

		if ((isset($params['active']) && $params['active'] == 1) || empty($params))
			$forms['active']['fields'][0]['checked'] = 'checked';

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
			'fullname'  => 'required',
			'username'  => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
			'email'     => 'required|valid_email|is_unique[users.email]',
			'password'  => 'required',
			'cpassword' => 'required|matches[password]',
		])) {
			$users = model('UserModel');

			$allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
			$user = new User($this->request->getPost($allowedPostFields));

			$user->activate();

			$users->save($user);

			$user = $users->where('email', $this->request->getPost('email'))->first();

			$userDetail = [
				'user_id'  => $user->id,
				'fullname' => $this->request->getPost('fullname'),
				'address'  => $this->request->getPost('address'),
				'phone'    => $this->request->getPost('phone')
			];

			$data = $this->request->getPost();
			if ($this->request->getMethod() == 'post' && $this->model->tambah($userDetail)) {
				$this->im_message->add('success', "Data berhasil disimpan");
				return redirect()->to('/support/users');
			} else {
				$this->im_message->add('danger', "Terjadi kesalahan saat menyimpan data");
			}
		} else {
			if ($this->request->getMethod() == 'post')
				$validation = \Config\Services::validation();
			else
				$validation = null;
		}

		$this->data['pageTitle']  = 'Users';
		$this->data['title']      = 'Create Users';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Users' => 'users', 'Create' => 'create'];

		$this->data['forms'] = $this->_form([], $validation);
		$this->data['js']    = ['assets/js/users/form.min.js'];
		$this->render('IM\CI\Views\vAForm');
	}

	private function _getDetail($id)
	{
		return $this->model->baris($id, ['select' => 'b.id, fullname name, address, phone, email, username, active, GROUP_CONCAT(c.group_id) groups']);
	}

	public function edit($id)
	{
		$id = decryptUrl($id);
		$data = $this->_getDetail($id);

		if (is_null($data)) {
			$this->im_message->add('danger', "Data tidak ditemukan");
			return redirect()->to('/support/users');
		}

		if ($this->validate([
			'name'          => 'required',
			'description'   => 'required',
			'serial_number' => 'required',
		])) {
			$before = $after = [];
			$newData = $this->request->getPost();
			foreach ($newData as $key => $value) {
				if ($key == 'id')
					$value = decryptUrl($value);
				if ($data[$key] != $value) {
					$before[$key] = $data[$key];
					$after[$key] = $value;
				}
			}
			if ($before) {
				$data = $this->request->getPost();
				$data['id'] = $id;
				if ($this->request->getMethod() == 'post' && $this->model->ubah($data)) {
					$this->im_message->add('success', "Data berhasil diperbarui");
					return redirect()->to('/support/devices');
				} else {
					$this->im_message->add('danger', "Terjadi kesalahan saat menyimpan data");
				}
			} else {
				$this->im_message->add('info', "Tidak ada perubahan data");
				return redirect()->to('/support/devices');
			}
		} else {
			if ($this->request->getMethod() == 'post')
				$validation = \Config\Services::validation();
			else
				$validation = null;
		}

		$this->data['pageTitle']  = 'Users';
		$this->data['title']      = 'Edit Users';
		$this->data['breadCrumb'] = ['Dashboard' => 'support', 'Users' => 'users', 'Edit' => 'edit'];

		$this->data['forms'] = $this->_form($data, $validation);
		$this->data['js']    = ['assets/js/users/form.min.js'];
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
			'detail'  => ($data) ? view('IM\CI\Views\vAModalDelete', $data) : ''
		];
		if ($this->request->isAJAX()) {
			$this->render();
		}
	}

	public function delete($id)
	{
		if ($this->request->getMethod() == 'delete' && $this->request->isAJAX()) {
			$id   = decryptUrl($id);
			$data = $this->model->find($id);

			if ($data) {
				$mode = $this->request->getRawInput()['permanent'];

				// if ($mode == 'true')
				// 	$delete = $this->model->hapusPermanen($id);
				// else
				// 	$delete = $this->model->hapus($id);
				$delete = true;

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
