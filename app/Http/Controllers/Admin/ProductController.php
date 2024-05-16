<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $products = Product::with([])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('admin.product.index')->with(['data' => $products]);
    }

    public function add()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->store();
        }
        return view('admin.product.add');
    }

    private $rule = [
        'name' => 'required',
        'price' => 'required',
    ];

    private $message = [
        'name.required' => 'kolom nama wajib diisi',
        'price.required' => 'kolom harga wajib diisi',
    ];

    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                return response()->json([
                    'status' => 400,
                    'message' => 'Harap Mengisi Kolom Dengan Benar...',
                    'data' => $errors
                ], 400);
            }

            $data_request = [
                'nama' => $this->postField('name'),
                'harga' => $this->postField('price'),
                'deskripsi' => $this->postField('description')
            ];

            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('assets/products');
                $documentName = $storage_path . '/' . $document;
                $data_request['gambar'] = '/assets/products/' . $document;
                $file->move($storage_path, $documentName);
            }

            Product::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menyimpan data product...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }
}
