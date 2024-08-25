<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use App\Models\UserModel;
 
class Register extends BaseController
{
 
    public function __construct(){
        helper(['form']);
    }
 
    public function index()
    {
        $data = [];
        return view('register', $data);
    }
   
    public function register()
    {
        $rules = [
            'user_name' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'user_email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.user_email]'],
            'user_password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[user_password]'],
            'role' => ['rules' => 'required|min_length[1]|max_length[255]']
        ];
           
 
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'user_name'    => $this->request->getVar('user_name'),
                'user_email'    => $this->request->getVar('user_email'),
                'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
                'role'    => $this->request->getVar('role'),
            ];
            $model->save($data);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            return view('register', $data);
        }
           
    }
    public function logoutregister() {
        session_destroy();
        return redirect()->to('/useradmin/register');
    }
}