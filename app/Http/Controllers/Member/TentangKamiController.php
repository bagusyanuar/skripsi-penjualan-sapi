<?php


namespace App\Http\Controllers\Member;


use App\Helper\CustomController;

class TentangKamiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('member.tentang');
    }
}