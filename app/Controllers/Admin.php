<?php

namespace App\Controllers;

class Admin extends BaseController
{
	public function index()
	{
        $data['title'] = 'Hello admin';
		return view('admin/dashboard', $data);
	}
}
