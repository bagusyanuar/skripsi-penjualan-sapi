<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Product;

class HomeController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $products = Product::with([])
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->offset(0)
            ->get();
        return view('member.beranda')->with(['products' => $products]);
    }
}
