<?php

namespace App\Models;

use CodeIgniter\Model;

class PrediksiModel extends Model
{
    protected $table = 'datasetmold'; // Ganti dengan nama tabel yang sesuai
    protected $allowedFields = ['grade-mold', 'qty-produk', 'cosmetic', 'Tonase', 'Weight', 'price-mold']; // Sesuaikan dengan atribut yang ada pada tabel

    // Metode untuk melakukan prediksi harga molding
    public function predictPrice($data)
    {
        // Di sini, Anda perlu menerapkan logika untuk memprediksi harga molding.
        // Anda dapat menggunakan algoritma Naive Bayes atau Random Forest, atau metode lainnya sesuai kebutuhan Anda.
        // Saya akan menyediakan contoh sederhana menggunakan pendekatan sederhana.
        
        // Contoh: Prediksi menggunakan rumus sederhana (misalnya, rata-rata harga molding)
        $predictedPrice = $this->calculateAveragePrice(); // Metode untuk menghitung rata-rata harga molding dari data training
        
        return $predictedPrice;
    }

    // Contoh metode untuk menghitung rata-rata harga molding dari data training
    private function calculateAveragePrice()
    {
        // Anda perlu mengambil data training dari database dan menghitung rata-rata harga molding
        // Ini hanya contoh sederhana, Anda perlu menyesuaikan dengan metode yang sesuai untuk aplikasi Anda
        
        $trainingData = $this->where('status', 'training')->findAll();
        
        $totalPrice = 0;
        $count = count($trainingData);
        
        foreach ($trainingData as $data) {
            $totalPrice += $data['price-mold'];
        }

        $averagePrice = $totalPrice / $count;

        return $averagePrice;
    }
}
