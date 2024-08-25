<?php 

namespace App\Models;

use CodeIgniter\Model;

class TestingSetModel extends Model {
    protected $table = 'testingset'; // Nama tabel untuk testing set
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','grade-mold', 'qty-produk', 'cosmetic', 'Tonase', 'Weight', 'price-mold', 'remark', 'status'];
  

    public function deleteAllData()
    {
        try {
            $this->db->table($this->table)->truncate(); // Menghapus semua data dari tabel
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}
