<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Results_view extends Controller
{
    public function index()
    {
        // Mengambil nilai akurasi dari sesi atau sumber lainnya
        $accuracy = session()->get('accuracy');
        
        // Memuat view dan mengirimkan nilai akurasi
        return view('results_view', ['accuracy' => $accuracy]);
    }
}

?>
