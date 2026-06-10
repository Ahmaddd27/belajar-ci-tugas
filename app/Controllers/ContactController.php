<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    public function index()
{

    if (!session()->get('isLoggedIn'))
        {
            return redirect()->to('/login');
        }
        
    if (session()->get('role') == 'admin') {
        return redirect()->to('/');
    }

    return view('v_contact');
}
}
