<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    private $rule = [
        'email' => 'required',
        'password' => 'required',
    ];

    private $message = [
        'email.required' => 'kolom email wajib di isi',
        'password.required' => 'kolom password wajib di isi',
    ];

    public function login()
    {
        if ($this->request->method() === 'POST') {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }

            $credentials = [
                'email' => $this->postField('email'),
                'password' => $this->postField('password')
            ];
            if ($this->isAuth($credentials)) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();;
        return redirect()->route('admin.login');
    }
}
