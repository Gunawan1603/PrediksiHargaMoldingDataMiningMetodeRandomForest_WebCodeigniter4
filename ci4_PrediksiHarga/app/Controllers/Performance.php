<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Performance extends Controller
{
    public function index()
    {
        // Ambil nilai persentase input dari file teks
        $file = WRITEPATH . 'persentase_input.txt'; // Sesuaikan dengan path yang sama seperti sebelumnya
        if (file_exists($file)) {
            $percentage = file_get_contents($file);
        } else {
            $percentage = 'N/A';
        }

        // Misalnya, melakukan perhitungan performa (contoh)
        $accuracy = 0.75; // Contoh nilai akurasi
        $classificationReport = [
            
        ];

        // Lakukan perhitungan performa dan tampilkan hasilnya ke view
        return view('performance_view', [
            'percentageInput' => $percentage,
            'accuracy' => $accuracy,
            'classificationReport' => $classificationReport,
        ]);
    }
}
