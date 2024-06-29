<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;

class PesananController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('member.pesanan.index');
    }

    public function detail($id)
    {
        return view('member.pesanan.detail');
    }

    public function pembayaran($id)
    {
        return view('member.pesanan.pembayaran');
    }
}
