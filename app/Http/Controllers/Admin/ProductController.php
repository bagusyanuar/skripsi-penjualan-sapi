<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
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

        if ($this->request->ajax()) {
            $products = Product::with(['kategori'])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($products);
        }
        return view('admin.product.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->store();
        }
        $categories = Kategori::all();
        return view('admin.product.add')->with([
            'categories' => $categories
        ]);
    }

    public function edit($id)
    {
        $data = Product::with([])
            ->findOrFail($id);
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->patch($data);
        }
        $categories = Kategori::all();
        return view('admin.product.edit')->with([
            'data' => $data,
            'categories' => $categories
        ]);
    }

    private $rule = [
        'name' => 'required',
        'price' => 'required',
        'age' => 'required',
        'weight' => 'required',
    ];

    private $message = [
        'name.required' => 'kolom nama wajib diisi',
        'price.required' => 'kolom harga wajib diisi',
        'age.required' => 'kolom umur wajib diisi',
        'weight.required' => 'kolom berat wajib diisi',
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
            $data_request = $this->getDataRequest();
            Product::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menyimpan data product...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    /**
     * @param $data Model
     * @return \Illuminate\Http\JsonResponse
     */
    private function patch($data)
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
            $data_request = $this->getDataRequest();
            $data->update($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil merubah data product...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private function getDataRequest()
    {
        $data_request = [
            'kategori_id' => $this->postField('category'),
            'nama' => $this->postField('name'),
            'harga' => $this->postField('price'),
            'berat' => $this->postField('weight'),
            'umur' => $this->postField('age'),
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

        return $data_request;
    }
}
