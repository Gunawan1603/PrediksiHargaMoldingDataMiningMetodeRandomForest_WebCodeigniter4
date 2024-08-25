<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\UserModel;
 
class Loginadmin extends BaseController
{
    public function indexadmin()
    {
        return view('useradmin/loginadmin');
    } 
   
    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

       $email = $this->request->getVar('user_email');
       $password = $this->request->getVar('user_password');
         
        $user = $userModel->where('user_email', $email)->first();
        
        
 
        if(is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

 
       $pwd_verify1 = password_verify($password, $user ['user_password']);
 
        if(!$pwd_verify1) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $ses_data = [
            'user_id' => $user['user_id'],
            'user_email' => $user['user_email'],
           'isLoggedIn' => TRUE,
           'role' => $user['role'], // Menambahkan peran pengguna ke sesi
        ];
 
        $session->set($ses_data);
        // Periksa peran pengguna dan arahkan sesuai peran
        if ($user['role'] === 'admin') {
            return redirect()->to('admin_dashboard');
        } elseif ($user['role'] === 'manager') {
            return redirect()->to('management_dashboard');
        } else {
            return redirect()->to('dashboard');
        }
    //}
        //return redirect()->to('dashboard');
         
        
    }

    public function logout() {
        session_destroy();
        return redirect()->to('/useradmin/login');
    }
    public function homepjm() {
        session()->destroy();
        return redirect()->to('/homepjm');
    }
    public function logoutadmin()
    {
        session()->destroy();
        //return redirect()->to('/user/login');
        return redirect()->to('login');
    }
    public function cancel()
    {
        //helper(['form']);
        session()->destroy();
        //return redirect()->to('/user/login');
        return redirect()->to('/homepjm');
    }
}