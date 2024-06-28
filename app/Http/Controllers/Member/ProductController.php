<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\Product;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            try {
                $q = $this->request->query->get('param');
                $c = $this->request->query->get('category');
                $query = Product::with([]);
                if ($c !== 'all' && $c !== '') {
                    $query->where('kategori_id', '=', $c);
                }
                $products = $query->where('nama', 'LIKE', '%' . $q . '%')
                    ->get();
                return $this->jsonSuccessResponse('success', $products);
            } catch (\Exception $e) {
                return $this->jsonErrorResponse('internal server error...');
            }
        }
        $categories = Kategori::all();
        return view('member.product.index')->with([
            'categories' => $categories
        ]);
    }

    public function detail($id)
    {
        $product = Product::with([])
            ->where('id', '=', $id)
            ->firstOrFail();
        return view('member.product.detail')->with(['product' => $product]);
    }
}
