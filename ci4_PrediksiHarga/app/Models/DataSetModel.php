<?php 

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class DataSetModel extends Model {
    protected $table = 'datasetmold';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'grade-mold', 'customer', 'part-application', 'qty-produk', 'Tonase', 'Resin-plastic', 'cosmetic', 'Cavity-Material', 'Core-Material', 'Slide-System', 'Lift-Core-System', 'Mold-Design-Type', 'Hot-Runner-System', 'Mold-Base-Order-Company', 'Weight', 'price-mold', 'remark', 'status'];
    protected $db; 

    public function add($data) {
        return $this->db
            ->table($this->table)
            ->insert($data);
    }

    public function insertFromCSV($data) {
        // return $this->db->table($this->table)->insert($data);
        return $this->insertBatch($data);
    }

    public function deleteAll() {
        return $this->db->table($this->table)->truncate(); // Gunakan truncate() untuk menghapus semua data
    }

    public function resetStatus() {
        return $this->db->table($this->table)
            ->update(['status' => '']);
    }

    public function __construct() {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
}
