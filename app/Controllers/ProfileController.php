<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $data = [
            'username' => session()->get('username'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
        ];

        return view('v_profile', $data);
    }
}
