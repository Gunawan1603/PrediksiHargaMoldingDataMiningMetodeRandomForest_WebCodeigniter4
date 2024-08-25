<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Config\View;

class Users extends BaseController
{
    protected $helpers = ['custom'];
    public function index()
    {
        $title = "Data User";
        $link = "users";
        $model = new UserModel();
        $users = $model->findAll();
        
        return view('/datauser', compact('users', 'title', 'link'));
    }

    public function __construct()
    {
        $db = db_connect();
        $this -> UserModel = new UserModel($db);
    }

    //==========================================================
    //=========================ADD==============================
    //==========================================================
    public function addkaryawan()
    {
        $title = "Tambah Data User";
        $link = "datauser/add";
        return view('adduser', compact('title', 'link'));
    }

    public function save()
    {
        //$user_id = $this->request->getPost('user_id');
        $user_name = $this->request->getPost('user_name');
        $user_email = $this->request->getPost('user_email');
        $user_role = $this->request->getPost('role');
        $user_password = $this->request->getPost('user_password');
        $user_created_at = $this->request->getPost('user_created_at');

        $data = [
            //'user_id'    => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'role' => $user_role,
            'user_password' => $user_password,
            'user_created_at' => $user_created_at
        ];

        $result = $this->UserModel->add($data);
        //if ($result > 0) {
        if ($result !== false) {
            echo ('Data berhasil ditambahkan');
            return redirect()->to(base_url('/datauser'));
        } else {
            echo ('Data gagal ditambahkan');
            return redirect()->to(base_url('/datauser/add'));
        }
    }    

    //============================================================
    //=========================EDIT===============================
    //============================================================

    public function edit($id)
    {
        helper(['form', 'url']);

        $title = "Edit Data User";
        $link = "users/edit";

       $UserModel = new UserModel();

       $data = array(
            'users' => $UserModel->find($id)
        );
        return view('editusers', compact('data','title', 'link'));
        
            //$model = new \App\Models\UserModel();
            //$data['user'] = $model->find($id);
    
            //echo view('users/edit', $data);
        
    }
    

    public function update($id)
    {   
        helper(['form', 'url']);

        $UserModel = new UserModel();
        $title = "Edit Data User";
        $link = "users/edit";
        
            //$user_id = $this->request->getPost('user_id');
            $user_name = $this->request->getPost('user_name');
            $user_email = $this->request->getPost('user_email');
            $user_role = $this->request->getPost('role');
            $user_password = $this->request->getPost('user_password');
            $user_created_at = $this->request->getPost('user_created_at');

            $data = [
                //'user_id'    => $user_id,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'role' => $user_role,
                'user_password' => $user_password,
                'user_created_at' => $user_created_at
            ];

            $result = $UserModel->update($id, $data);
            //if ($result > 0) {
            if ($result !== false) {
                echo ('Data berhasil diubah');
                //return redirect()->to(base_url('/datauser'));
                return redirect()->to('/users');
            } else {
                echo ('Data gagal diubah');
                return redirect()->to(base_url('/datauser/edit/' . $id));
            }
    }


    //==============================================================
    //=========================DELETE===============================
    //==============================================================
    public function delete($user_id)
    {
        $UserModel = new UserModel();
        $title = "Hapus Data User";
        $link = "users/delete";

        $users = $UserModel->find($user_id);

        if($users){
            $UserModel->delete($user_id);
            echo ('Data berhasil dihapus');
            //return redirect()->to(base_url('/datauser'));
            return redirect()->to('/users');
        }
    }
    
} //.end of class Page