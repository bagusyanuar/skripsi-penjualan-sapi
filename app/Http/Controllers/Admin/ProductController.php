<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function add()
    {
        return view('admin.product.add');
    }
}
