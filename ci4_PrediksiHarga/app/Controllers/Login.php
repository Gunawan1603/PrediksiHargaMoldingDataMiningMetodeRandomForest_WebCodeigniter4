<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $helpers = ['custom'];

    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getVar('user_email');
        $password = $this->request->getVar('user_password');

        $user = $userModel->where('user_email', $email)->first();

        if (is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        $pwd_verify = password_verify($password, $user['user_password']);

        if (!$pwd_verify) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        $ses_data = [
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name'],
            'user_email' => $user['user_email'],
            'role' => $user['role'], // Tambahkan role ke data sesi
            'isLoggedIn' => true
        ];

        $session->set($ses_data);

        // Redirect sesuai role pengguna
        if ($user['role'] == 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/user/dashboard');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    //public function loginadmin()
   // {
        //session()->destroy();
        //return redirect()->to('/admin/login-admin');
    //}

    public function loginadmin()
    {
        //if (!session()->get('isLoggedIn')) {
            session()->destroy();
            //return redirect()->to('/admin/login-admin');
    //}

        return view('admin/loginadmin'); // Menampilkan view loginadmin
    }
}
