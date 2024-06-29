<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends CustomController
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
                $role = \auth()->user()->role;
                if ($role === 'customer') {
                    return redirect()->route('member.home');
                }
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
        }
        return view('member.login');
    }

    private $rule_register = [
        'email' => 'required|email',
        'username' => 'required',
        'password' => 'required|min:8',
    ];

    private $message_register = [
        'email.required' => 'kolom email wajib di isi',
        'email.email' => 'alamat email tidak valid',
        'username.required' => 'kolom usernam wajib di isi',
        'password.required' => 'kolom password wajib di isi',
        'password.min' => 'kolom password minimal 8 karakter',
    ];

    public function register()
    {
        if ($this->request->method() === 'POST') {
            try {
                $validator = Validator::make($this->request->all(), $this->rule_register, $this->message_register);
                if ($validator->fails()) {
                    return redirect()->back()->with('failed', 'harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
                }
                $data_account = [
                    'email' => $this->postField('email'),
                    'username' => $this->postField('username'),
                    'password' => Hash::make($this->postField('password')),
                    'role' => 'customer'
                ];
                DB::beginTransaction();
                $user = User::create($data_account);
                $data_customer = [
                    'user_id' => $user->id,
                    'nama' => $this->postField('name'),
                    'no_hp' => $this->postField('phone'),
                    'alamat' => $this->postField('address')
                ];
                Customer::create($data_customer);
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil melakukan registrasi');
            }catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
                return redirect()->back()->with('failed', 'terjadi kesalahan server...')->withInput();
            }
        }
        return view('member.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('member.home');
    }
}
