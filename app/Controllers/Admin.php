<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(){
        return view('admin/index');
    }

    public function supplier(){
        return view('admin/supplier');
    }

    public function customer(){
        return view('admin/customer');
    }

    public function stock(){
        return view('admin/stock');
    }

    public function masuk(){
        return view('admin/barang_masuk');
    }

    public function keluar(){
        return view('admin/barang_keluar');
    }

    public function retur_masuk(){
        return view('admin/retur_masuk');
    }

    public function laporan_masuk(){
        return view('admin/laporan_masuk');
    }

    public function laporan_keluar(){
        return view('admin/laporan_keluar');
    }

    public function logout(){
        session() -> destroy();
        return redirect() -> to('home');
    }
}
