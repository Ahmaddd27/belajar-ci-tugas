<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class Home extends BaseController
{

   protected $ProductModel;

   function __construct(){
      helper(['number', 'form']);
      $this->ProductModel = new ProductModel();
   }

    public function index()
    {
       helper('form');
      $product = $this->ProductModel->findAll();
      $data['product'] = $product;
       return view('v_home', $data);
    }
     public function contact()
    {
       return view('v_contact');
    }
}