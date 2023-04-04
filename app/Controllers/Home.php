<?php

namespace App\Controllers;

use PHPUnit\Framework\Constraint\IsEqualIgnoringCase;

class Home extends BaseController
{
    public function index()
    {
        $ModelUser = new \App\Models\UserModel();
        $login = $this -> request -> getPost('btnLogin');

        if($login){
            $email = $this -> request -> getPost('email');
            $password = $this -> request -> getPost('password');

            if($email == "" or $password == ""){
                $err ="Silahkan Masukkan Email & Password !!!";
            }
            
            if(empty($err)){
                $dataUser = $ModelUser -> where("email", $email) -> first();
                if($dataUser['password'] != $password){
                    $err = "Password Tidak Sesuai !!!";
                }
            }
            
            if(empty($err)){
                $dataSesi = [
                    'id' => $dataUser['id_user'],
                    'email' => $dataUser['email'],
                    'password' => $dataUser['password'],
                    'tipe_akun' => $dataUser['tipe_akun']
                ];

                session() -> set($dataSesi);
                if($dataUser['tipe_akun'] == "Owner"){
                    return redirect() -> to('owner');
                } else if ($dataUser['tipe_akun'] == "Admin"){
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
