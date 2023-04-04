<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(){
        return view('user/index');
    }

    public function masuk(){
        return view('user/barang_masuk');
    }

    public function keluar(){
        return view('user/barang_keluar');
    }

    public function retur_masuk(){
        return view('user/retur_masuk');
    }

    public function laporan_masuk(){
        return view('user/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('user/laporan_keluar');
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
