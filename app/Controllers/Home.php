<?php

namespace App\Controllers;

use PHPUnit\Framework\Constraint\IsEqualIgnoringCase;

class Home extends BaseController
{
    public function index()
    {
        $ModelAkun = new \App\Models\AkunModel();
        $login = $this -> request -> getPost('btnLogin');

        if($login){
            $id = $this -> request -> getPost('id_user');
            $password = $this -> request -> getPost('password');

            if($id == "" or $password == ""){
                $err ="Silahkan Masukkan ID User & Password !!!";
            }
            
            if(empty($err)){
                $dataAkun = $ModelAkun -> where("id_user", $id) -> first();
                if($dataAkun['password'] != $password){
                    $err = "Password Tidak Sesuai !!!";
                }
            }
            
            if(empty($err)){
                $dataSesi = [
                    'id' => $dataAkun['id_user'],
                    'email' => $dataAkun['email'],
                    'nama_lengkap' => $dataAkun['nama_lengkap'],
                    'password' => $dataAkun['password'],
                    'tipe_akun' => $dataAkun['tipe_akun']
                ];

                session() -> set($dataSesi);
                if($dataAkun['tipe_akun'] == "Owner"){
                    return redirect() -> to('owner');
                } else if ($dataAkun['tipe_akun'] == "Admin"){
                    return redirect() -> to('admin');
                } else {
                    return redirect() -> to('user');
                }
            }
            
            if($err){
                session() -> setFlashData('error', $err);
            }
        }
        return view('auth/login');
    }
}
