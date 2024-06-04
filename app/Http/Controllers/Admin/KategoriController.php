<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;

class KategoriController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.kategori.index');
    }

    public function add()
    {
        return view('admin.kategori.add');
    }

    public function edit($id)
    {
        return view('admin.kategori.edit');
    }
}
