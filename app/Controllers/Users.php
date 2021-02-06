<?php

namespace App\Controllers;
use App\Libraries\Crud;

class Users extends BaseController
{
	protected $crud;

	function __construct(){
		$params = [
			'table' => 'users',
			'dev' => false,
			'fields' => $this->field_options(),
			'form_title_add' => 'Add User',
			'form_title_update' => 'Edit User',
			'form_submit' => 'Add',
			'table_title' => 'Users',
			'form_submit_update' => 'Update',
			'base' => ''
		];
		$this->crud = new Crud($params, service('request'));
	}

	public function index()
	{
		$page = 1;
		if (isset($_GET['page'])) {
			$page = (int) $_GET['page'];
			$page = max(1, $page);
		} 

		$data['title'] = $this->crud->getTableTitle();
		$per_page = 20;
		$columns = ['u_id', 'u_firstname', 'u_lastname', 'u_email', 'u_status'];
		$where = ['u_status' => 'Active'];
		$order = [
			['u_id', 'ASC']
		];
		$data['table'] = $this->crud->view($page,$per_page,$columns,$where,$order);
		return view('admin/users/table', $data);
	}

	protected function field_options(){
		$fields = [];
		$fields['u_firstname'] = ['label' => 'First Name'];
		$fields['u_lastname'] = ['label' => 'Last Name'];
		$fields['u_email'] = ['label' => 'Email'];
		$fields['u_status'] = ['label' => 'Status'];
		return $fields;
	}
}
