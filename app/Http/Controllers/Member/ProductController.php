<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Product;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('member.product.index');
    }

    public function detail($id)
    {
        $product = Product::with([])
            ->where('id', '=', $id)
            ->firstOrFail();
        return view('member.product.detail')->with(['product' => $product]);
    }
}
