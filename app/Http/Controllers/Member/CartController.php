<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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

    public function checkout()
    {
        try {
            DB::beginTransaction();
            $userID = auth()->id();

            $is_pcb = $this->postField('pcb');

            $transactionRef = 'HFP-' . date('YmdHis');
            /** @var Collection $carts */
            $carts = Keranjang::with(['product'])
                ->whereNull('penjualan_id')
                ->where('user_id', '=', auth()->id())
                ->orderBy('id', 'ASC')
                ->get();

            if (count($carts) <= 0) {
                return $this->jsonErrorResponse('belum ada data belanja...');
            }

            $total = $carts->sum('total');
            $data_request = [
                'user_id' => $userID,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'no_penjualan' => $transactionRef,
                'total' => $total,
                'status' => 0,
                'tanggal_check' => null,
                'alamat' => $this->postField('address')
            ];

            if ($is_pcb === '1') {
                $data_request['tanggal_check'] = $this->postField('pcb_date');
            }

            $transaction = Penjualan::create($data_request);
            /** @var Model $cart */
            foreach ($carts as $key => $cart) {
                $data_new_cart = [
                    'penjualan_id' => $transaction->id
                ];
                $cart->update($data_new_cart);
            }
            $transID = $transaction->id;
            DB::commit();
            return redirect()->back()->with('success', 'berhasil melakukan pemesanan...')->with('id', $transID);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
