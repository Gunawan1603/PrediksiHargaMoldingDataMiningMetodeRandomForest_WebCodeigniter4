<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    protected $helpers = ['custom'];
    public function index(){
        return view('dashboard');
        //$session = session();
        //echo "Welcome Back - ".$session->get('user_name');
    }
}
