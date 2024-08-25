<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id','user_name', 'user_email','role', 'user_password', 'user_created_at'];

    function add($data){
        return $this->db
        ->table($this->table)
        ->insert($data);
    }
}