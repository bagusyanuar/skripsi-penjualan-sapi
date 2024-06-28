<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->addToCart();
        }

        $profile = Customer::with([])
            ->where('user_id', '=', auth()->id())
            ->first();

        $address = $profile->alamat;

        /** @var Collection $carts */
        $carts = Keranjang::with(['product.kategori'])
            ->whereNull('penjualan_id')
            ->where('user_id', '=', auth()->id())
            ->get();
        $subTotal = 0;
        if (count($carts) > 0) {
            $subTotal = $carts->sum('total');
        }
        return view('member.keranjang')->with([
            'carts' => $carts,
            'subTotal' => $subTotal,
            'address' => $address
        ]);
    }

    public function delete($id)
    {
        try {
            Keranjang::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private function addToCart()
    {
        try {
            $userID = auth()->id();
            $productID = $this->postField('id');
            $qty = 1;

            $product = Product::with([])
                ->where('id', '=', $productID)
                ->firstOrFail();
            if (!$product) {
                return $this->jsonErrorResponse('product tidak ditemukan');
            }

            $productPrice = $product->harga;
            $total = (int) $qty * $productPrice;
            $data_request = [
                'user_id' => $userID,
                'penjualan_id' => null,
                'product_id' => $productID,
                'qty' => $qty,
                'harga' => $productPrice,
                'total' => $total
            ];
            Keranjang::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menambahkan keranjang...');
        }catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }
}
