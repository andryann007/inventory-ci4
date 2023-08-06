<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Home extends BaseController
{
    protected $akunModel;
    protected $emailSMTP;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->emailSMTP = \Config\Services::email();
    }

    public function index()
    {
        $ModelAkun = new \App\Models\AkunModel();
        $login = $this -> request -> getPost('btnLogin');

        if($login){
            $username = $this -> request -> getPost('username');
            $password = $this -> request -> getPost('password');

            $dataAkun = $ModelAkun -> where("username", $username) -> first();

            if($username != $dataAkun['username']) :
                $err = "Username Tidak Terdaftar !!!";
            endif;

            if($password != $dataAkun['password']) :
                $err = "Password Tidak Sesuai !!!";
            endif;
            
            if(empty($err)){
                $dataSesi = [
                    'id_user' => $dataAkun['id_user'],
                    'nama_lengkap' => $dataAkun['nama_lengkap'],
                    'email' => $dataAkun['email'],
                    'username' => $dataAkun['username'],
                    'password' => $dataAkun['password'],
                    'telp' => $dataAkun['telp'],
                    'alamat' => $dataAkun['alamat'],
                    'tipe_akun' => $dataAkun['tipe_akun']
                ];

                session() -> set($dataSesi);
                
                if($dataAkun['tipe_akun'] == "owner"){
                    session()->set('logged_in', true);
                    session()->setFlashdata('message', 'Berhasil Login Sebagai Owner !!!');
                    return redirect() -> to('owner');
                } 
                
                else if ($dataAkun['tipe_akun'] == "admin"){
                    session()->set('logged_in', true);
                    session()->setFlashdata('message', 'Berhasil Login Sebagai Admin !!!');
                    return redirect() -> to('admin');
                } else {
                    session()->set('logged_in', true);
                    session()->setFlashdata('message', 'Berhasil Login Sebagai User !!!');
                    return redirect() -> to('user');
                }
            }
            
            if($err){
                session() -> setFlashData('error', $err);
            }
        }
        return view('auth/login');
    }

    public function forget_password(){
        $ModelAkun = new \App\Models\AkunModel();
        $akun = new AkunModel();

        $sendToken = $this -> request -> getPost('btnSendToken');

        if($sendToken){
            $email = $this -> request -> getPost('email');
            $akunData = $akun->where('email', $email)->first();

            if($akunData){
                if($email == $akunData['email']){
                    // Character That Been Use In Reset Token
                    $tokenCharacter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $pieces  = [];
                    $max = mb_strlen($tokenCharacter, '8bit') - 1;
                    
                    // Generate Random 12 Reset Token
                    for($i = 0; $i < 12; ++$i){
                        $pieces[] = $tokenCharacter[random_int(0, $max)];
                    }
    
                    $resetToken = implode('', $pieces);
    
                    $recipientsName = $akunData['nama_lengkap'];
    
                    // Send Reset Token To User Email
                    $this->emailSMTP->setFrom("andryancoolz@gmail.com", "Andryan");
                    $this->emailSMTP->setTo($email);
                    $this->emailSMTP->setSubject("Password Reset Token");
                    $this->emailSMTP->setMessage("Hi, <b>{$recipientsName}</b> We're sending you this email because you requested a password reset.<br>
                    Here is your token to reset your password <b>{$resetToken}</b>.<br>
                    To reset your password go to link below :<br>
                    <b>http://localhost:8080/home/reset_password</b><br><br><br>
                    Thanks & Regards<br>
                    Andryan");
                    $sendResetToken = $this->emailSMTP->send();

                    // Update New Reset Token in User Database
                    $data = array(
                        'reset_token' => $resetToken
                    );
                    $setNewResetToken = $ModelAkun->updateData($data, $akunData['id_user']);

                    if($sendResetToken && $setNewResetToken){
                    session() -> setFlashdata('forget_password_message', 'Berhasil Mengirim Reset Token & Update Reset Token !!!');
                    }
    
                    else{
                        session() -> setFlashdata('forget_password_error', 'Gagal Mengirim Reset Token !!!');
                    }
                } 
            } else {
                session() -> setFlashdata('forget_password_error', 'Email Tidak Terdaftar !!!');
            }
        }
        return view('auth/forget_password');
    }

    public function reset_password(){
        $ModelAkun = new \App\Models\AkunModel();

        $resetPassword = $this -> request -> getPost('btnResetPass');

        if($resetPassword){
            $email = $this -> request -> getPost('email');
            $token = $this -> request -> getPost('token');
            $password = $this -> request -> getPost('password');
            $confirmPassword = $this -> request -> getPost('confirmPassword');

            $dataAkun = $ModelAkun -> where("email", $email) -> first();

            if($email != $dataAkun['email']) :
                $err = "Email Tidak Terdaftar !!!";
                session() -> setFlashData('reset_password_error', $err);
            endif;

            if($token != $dataAkun['reset_token'] || $token == "") :
                $err = "Reset Token Tidak Sesuai !!!";
                session() -> setFlashData('reset_password_error', $err);
            endif;

            if(empty($err)){
                if($email == $dataAkun['email'] && $token == $dataAkun['reset_token']){
                    if($password == $confirmPassword){
                        $data = array(
                            'password' => $password,
                            'reset_token' => ""
                        );
                        $ModelAkun -> updateData($data, $dataAkun['id_user']);
                        session() -> setFlashdata('reset_password_message', 'Berhasil Mereset Password & Reset Token !!!');
                    } else {
                        session()->setFlashdata('reset_password_error', 'Password & Password Konfirmasi Tidak Sama !!!');
                    }
                }
            }
        }

        return view('auth/reset_password');
    }
}
