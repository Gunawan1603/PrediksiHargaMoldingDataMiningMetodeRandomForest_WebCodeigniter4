<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PrediksiPrice extends BaseController
{
    public function index()
    {
        return view('prediksi_view');
    }

    public function proses_prediksiharga()
{
    // Mendapatkan nilai dari inputan form
    // Di dalam method atau fungsi yang menangani proses prediksi dan menyiapkan hasil
    $grade_mold = $this->request->getPost('grade-mold');
    $part_application = $this->request->getPost('part-application');
    $qty_produk = $this->request->getPost('qty-produk');
    $tonase = $this->request->getPost('Tonase');
    //$cosmetic = $this->request->getPost('cosmetic');
    $cavity_material = $this->request->getPost('Cavity-Material');
    $core_material = $this->request->getPost('Core-Material');
    $slide_system = $this->request->getPost('Slide-System');
    $lift_core_system = $this->request->getPost('Lift-Core-System');
    //$hot_runner_system = $this->request->getPost('Hot-Runner-System');

    // Mengonversi nilai string menjadi kode label numerik
    $part_application_encoded = $this->encode_value($part_application, ['AC' => 0, 'Camera' => 1, 'Car' => 2, 'Loundry' => 3, 'MotorCycle' => 4, 'Piano' => 5, 'Printer' => 6, 'Refrigerator' => 7, 'Speaker' => 8, 'TV-Monitor' => 9, 'WaterMeter' => 10]);
    //$cosmetic_encoded = $this->encode_value($cosmetic, ['YES' => 1, 'NO' => 0]);
    $cavity_material_encoded = $this->encode_value($cavity_material, ['CENA-1' => 0, 'CENA-G' => 1, 'HP4M' => 2, 'HP4' => 3, 'HPM7' => 4, 'NAK80' => 5, 'P20' => 6, 'PX4' => 7, 'PXA30' => 8, 'S50C' => 9, 'S55C' => 10, 'S-718' => 11, 'SKD61' => 12, 'STAVAX' => 13, '2316' => 14, '2738' => 15]);
    $core_material_encoded = $this->encode_value($core_material, ['CENA-G' => 0, 'HP4' => 1, 'HP4M' => 2, 'HPM7' => 3, 'NAK80' => 4, 'P20' => 5, 'PX4' => 6, 'PXA30' => 7, 'S50C' => 8, 'S55C' => 9, 'SKD61' => 10, 'STAVAX' => 11, '2316' => 12, '2738' => 13]);
    $slide_system_encoded = $this->encode_value($slide_system, ['YES' => 1, 'NO' => 0]);
    $lift_core_system_encoded = $this->encode_value($lift_core_system, ['YES' => 1, 'NO' => 0]);
    //$hot_runner_system_encoded = $this->encode_value($hot_runner_system, ['YUDO' => 0, 'HOTPLUS' => 1, 'HOTSYS' => 2, 'MOLD-MASTER' => 3, 'YUDO-INDONESIA' => 4, 'NOTYET' => 5]);

    // Simpan nilai-nilai ini dalam session untuk digunakan dalam fungsi exportToExcel
    session()->set([
        'grade_mold' => $grade_mold,
        'part_application_encoded' => $part_application_encoded,
        'qty_produk' => $qty_produk,
        'tonase' => $tonase,
        //'cosmetic_encoded' => $cosmetic_encoded,
        'cavity_material_encoded' => $cavity_material_encoded,
        'core_material_encoded' => $core_material_encoded,
        'slide_system_encoded' => $slide_system_encoded,
        'lift_core_system_encoded' => $lift_core_system_encoded,
        //'hot_runner_system_encoded' => $hot_runner_system_encoded
    ]);

    // Load path skrip Python
    $python_script = APPPATH . 'Python/predict_price.py'; // Sesuaikan dengan path absolut skrip Python Anda

    // Eksekusi skrip Python dengan nilai input sebagai argumen
    //$output = shell_exec("python $python_script $grade_mold $part_application_encoded $qty_produk $tonase $cosmetic_encoded $cavity_material_encoded $core_material_encoded $slide_system_encoded $lift_core_system_encoded $hot_runner_system_encoded 2>&1");
    $output = shell_exec("python $python_script $grade_mold $part_application_encoded $qty_produk $tonase $cavity_material_encoded $core_material_encoded $slide_system_encoded $lift_core_system_encoded 2>&1");


    // Cek apakah eksekusi skrip berhasil
    if ($output !== null) {
        // Parsing output untuk mendapatkan hasil prediksi
        $predictions = explode("\n", trim($output));

        // Menghapus baris terakhir yang kosong
        array_pop($predictions);

        // Mendapatkan hasil akurasi dari baris terakhir
        $accuracy = end($predictions);

        // Memeriksa apakah nilai akurasi adalah angka
        if (is_numeric($accuracy)) {
            // Konversi nilai akurasi menjadi persentase dengan dua angka di belakang koma
            $accuracy_percentage = number_format($accuracy * 100, 2) . '%';
        } else {
            $accuracy_percentage = 'Data akurasi tidak valid';
        }

         // Memasukkan nilai MAE dan MAPE
         $mae_price = '';  // Inisialisasi nilai MAE
         $mape_price = ''; // Inisialisasi nilai MAPE
         foreach ($predictions as $prediction) {
             if (strpos($prediction, 'MAE Price:') !== false) {
                 $mae_price = trim(explode(':', $prediction)[1]);
             }
             if (strpos($prediction, 'MAPE Price:') !== false) {
                 $mape_price = trim(explode(':', $prediction)[1]);
             }
         }

        // Simpan hasil prediksi dalam file notepad
        $filePath = WRITEPATH . 'uploads/' . date('Y-m-d_H.i.s') . '_predictions.txt';
        $fp = fopen($filePath, 'w');
        if ($fp === false) {
            return view('prediksi_result', ['error_message' => 'Gagal membuat file untuk menyimpan prediksi.']);
        }
        foreach ($predictions as $prediction) {
            fwrite($fp, $prediction . PHP_EOL);
        }
        fclose($fp);

        // Simpan path file notepad dalam session
        session()->set('predictions_file', $filePath);

        // Menghapus baris terakhir dari array
        array_pop($predictions);

        // Memasukkan hasil prediksi, akurasi, MAE, dan MAPE ke view
        return view('prediksi_result', [
            'predictions' => $predictions,
            'accuracy' => $accuracy_percentage,
            'mae_price' => $mae_price,
            'mape_price' => $mape_price,
            'success_message' => 'Eksekusi script berhasil.'
        ]);
    } else {
        // Eksekusi script gagal
        return view('prediksi_result', ['error_message' => 'Gagal menjalankan script Python.']);
    }
}

    // Fungsi untuk melakukan label encoding pada nilai
    private function encode_value($value, $label_encoding)
    {
        return $label_encoding[$value];
    }

    // Fungsi decode_value
    private function decode_value($value, $mapping)
    {
        $decoded = array_search($value, $mapping);
        return $decoded !== false ? $decoded : $value;
    }

    public function plotConfusionMatrix()
    {
        // Tentukan nama file untuk gambar matriks kebingungan
        $imageName = 'confusion_matrix.png';

        // Jalur lengkap ke file gambar
        $imagePath = base_url('confusion_matrix/' . $imageName);

        // Simpan gambar matriks kebingungan tanpa tanggal dan waktu
        $directory = 'confusion_matrix/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $imageFullPath = $directory . $imageName;

        // Panggil fungsi untuk menghasilkan matriks kebingungan dan menyimpannya sebagai gambar
        $this->generateConfusionMatrixPlot($imageFullPath);

        // Kembalikan jalur file gambar sebagai respons JSON
        return $this->response->setJSON(['image_path' => $imagePath]);
    }

    private function generateConfusionMatrixPlot($imageFullPath)
    {
        // Misalnya, Anda dapat menggunakan library atau fungsi Python di sini untuk menghasilkan gambar
        // Pastikan untuk menyimpan gambar ke $imageFullPath dengan benar
    }

    public function exportToExcel()
    {
        /// Dapatkan path file notepad dari session
        $filePath = session()->get('predictions_file');

        // Validasi path file
        if (!$filePath || !file_exists($filePath)) {
            return $this->response->setJSON(['error' => 'File prediksi tidak ditemukan']);
        }

        // Baca isi file notepad
        $predictions = file($filePath, FILE_IGNORE_NEW_LINES);

        // Validasi isi file
        if (!$predictions) {
            return $this->response->setJSON(['error' => 'Tidak dapat membaca hasil prediksi']);
        }

        // Dapatkan nilai dari session
        // Dapatkan nilai dari session dan decode
        $grade_mold = session()->get('grade_mold');
        $part_application = $this->decode_value(session()->get('part_application_encoded'), ['AC' => 0, 'Camera' => 1, 'Car' => 2, 'Loundry' => 3, 'MotorCycle' => 4, 'Piano' => 5, 'Printer' => 6, 'Refrigerator' => 7, 'Speaker' => 8, 'TV-Monitor' => 9, 'WaterMeter' => 10]);
        $qty_produk = session()->get('qty_produk');
        $tonase = session()->get('tonase');
        //$cosmetic = $this->decode_value(session()->get('cosmetic_encoded'), ['YES' => 1, 'NO' => 0]);
        $cavity_material = $this->decode_value(session()->get('cavity_material_encoded'), ['CENA-1' => 0, 'CENA-G' => 1, 'HP4M' => 2, 'HP4' => 3, 'HPM7' => 4, 'NAK80' => 5, 'P20' => 6, 'PX4' => 7, 'PXA30' => 8, 'S50C' => 9, 'S55C' => 10, 'S-718' => 11, 'SKD61' => 12, 'STAVAX' => 13, '2316' => 14, '2738' => 15]);
        $core_material = $this->decode_value(session()->get('core_material_encoded'), ['CENA-G' => 0, 'HP4' => 1, 'HP4M' => 2, 'HPM7' => 3, 'NAK80' => 4, 'P20' => 5, 'PX4' => 6, 'PXA30' => 7, 'S50C' => 8, 'S55C' => 9, 'SKD61' => 10, 'STAVAX' => 11, '2316' => 12, '2738' => 13]);
        $slide_system = $this->decode_value(session()->get('slide_system_encoded'), ['YES' => 1, 'NO' => 0]);
        $lift_core_system = $this->decode_value(session()->get('lift_core_system_encoded'), ['YES' => 1, 'NO' => 0]);
        //$hot_runner_system = $this->decode_value(session()->get('hot_runner_system_encoded'), ['YUDO' => 0, 'HOTPLUS' => 1, 'HOTSYS' => 2, 'MOLD-MASTER' => 3, 'YUDO-INDONESIA' => 4, 'NOTYET' => 5]);

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set logo di sebelah kanan atas
        $logoPath = FCPATH . 'assets/images/logo.png'; // Sesuaikan dengan path logo Anda
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath($logoPath);
        $drawing->setWidth(50); // Sesuaikan ukuran logo sesuai kebutuhan
        $drawing->setCoordinates('B2'); // Koordinat logo di sebelah kanan atas
        $drawing->setWorksheet($sheet);

        // Set logo di sebelah kanan atas
        $logoPath = FCPATH . 'assets/images/mold.png'; // Sesuaikan dengan path logo Anda
        $drawing = new Drawing();
        $drawing->setName('mold');
        $drawing->setDescription('mold');
        $drawing->setPath($logoPath);
        // Set ukuran gambar
        $drawing->setWidth(100);
        $drawing->setHeight(150);
        $drawing->setCoordinates('F35'); // Koordinat logo di sebelah kanan atas
        $drawing->setWorksheet($sheet);
        $sheet->setCellValue('A1', 'PT. XYZ MOLD INDONESIA');

        // Judul dengan huruf tebal, size 15
        $sheet->setCellValue('C2', 'Prediksi Harga Molding Menggunakan Metode Random Forest');
        $sheet->getStyle('C2')->getFont()->setBold(true)->setSize(13);

        // Header
        $sheet->setCellValue('A4', 'No');
        $sheet->getStyle('A4')->getFont()->setBold(true);
        $sheet->setCellValue('B4', 'Prediction');
        $sheet->getStyle('B4')->getFont()->setBold(true);
        $sheet->setCellValue('A25', 'Confusion Matrix:');
        $sheet->getStyle('A25')->getFont()->setBold(true);

        // Data prediksi
        foreach ($predictions as $index => $prediction) {
            $sheet->setCellValue('A' . ($index + 5), $index + 1);
            $sheet->setCellValue('B' . ($index + 5), $prediction);
        }

        // Menambahkan gambar confusion matrix ke dalam spreadsheet
        $drawing = new Drawing();
        $drawing->setName('Confusion Matrix');
        $drawing->setDescription('Confusion Matrix');
        $drawing->setPath(FCPATH . 'confusion_matrix/confusion_matrix.png'); // Pastikan path ini benar
        // Set ukuran gambar
        $drawing->setWidth(150);
        $drawing->setHeight(150);
        $drawing->setCoordinates('D25'); // Koordinat gambar dalam spreadsheet
        $drawing->setWorksheet($sheet);

        // Menambahkan data lainnya ke dalam spreadsheet
        $sheet->setCellValue('A33', 'Atribut 8 Label dengan Ratio Split 90:10 Prediksi Harga Molding :');
        $sheet->getStyle('A33')->getFont()->setBold(true);
        // Header
        $sheet->setCellValue('A34', 'Mold-Atribut');
        $sheet->getStyle('A34')->getFont()->setBold(true);
        $sheet->setCellValue('D34', 'Value');
        $sheet->getStyle('D34')->getFont()->setBold(true);
        $sheet->setCellValue('A35', '1. Grade Mold :');
        $sheet->setCellValue('D35', $grade_mold);
        $sheet->setCellValue('A36', '2. Part Application :');
        $sheet->setCellValue('D36', $part_application);
        $sheet->setCellValue('A37', '3. Quantity Produk :');
        $sheet->setCellValue('D37', $qty_produk);
        $sheet->setCellValue('A38', '4. Tonase :');
        $sheet->setCellValue('D38', $tonase);
        //$sheet->setCellValue('A39', '5. Cosmetic :');
        //$sheet->setCellValue('D39', $cosmetic);
        $sheet->setCellValue('A39', '5. Cavity Material :');
        $sheet->setCellValue('D39', $cavity_material);
        $sheet->setCellValue('A40', '6. Core Material :');
        $sheet->setCellValue('D40', $core_material);
        $sheet->setCellValue('A41', '7. Slide System :');
        $sheet->setCellValue('D41', $slide_system);
        $sheet->setCellValue('A42', '8. Lift Core System :');
        $sheet->setCellValue('D42', $lift_core_system);
        //$sheet->setCellValue('A44', '10. Hot Runner System :');
        //$sheet->setCellValue('D44', $hot_runner_system);

        $sheet->getStyle('A4:J4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A33:J33')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Set text alignment ke center untuk range 'A4:A17'
        $sheet->getStyle('A4:A25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('B4:J4');
        $sheet->getStyle('A4:A25')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle('D34:D44')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A33:J33');
        $sheet->getStyle('D34:D44')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


        // Menambahkan border luar pada sel data prediksi
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

         $styleArray = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => ['argb' => '00000000'],
            ],
            ],
         ];

         $sheet->getStyle('A1:J' . $highestRow)->applyFromArray($styleArray);
        



        // Format untuk B8 dan C8
        $styleB8C8 = $sheet->getStyle('B8:D8');
        $styleB8C8->getFont()->setBold(true);
        $styleB8C8->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('d4edda'); // Hijau muda

        $styleB9C9 = $sheet->getStyle('B9:D9');
        $styleB9C9->getFont()->setBold(true);
        $styleB9C9->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('cfe2ff'); // Light Blue

        // Path untuk menyimpan file
        $uploadDir = WRITEPATH . 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate nama file berdasarkan tahun, tanggal, dan waktu
        $filename = date('Y-m-d_H.i.s') . '_predictions.xlsx';
        $filePath = $uploadDir . $filename;

        // Simpan spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Kembalikan jalur relatif ke metode downloadExcel
        return $this->response->setJSON(['file_path' => base_url('PrediksiPrice/downloadExcel/' . urlencode($filename))]);
    }

    public function downloadExcel($filename)
    {
        // Dapatkan jalur lengkap file
        $filePath = WRITEPATH . 'uploads/' . $filename;

        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Unduh file dengan menggunakan response download
            return $this->response->download($filePath, null)->setFileName($filename);
        } else {
            // File tidak ditemukan, lempar exception PageNotFoundException
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }
    }

    public function listUploadedFiles()
{
    // Direktori tempat menyimpan file yang diunggah
    $uploadDir = WRITEPATH . 'uploads/';

    // Inisialisasi array untuk menyimpan daftar file
    $fileList = [];

    // Periksa apakah direktori ada
    if (is_dir($uploadDir)) {
        // Buka direktori
        if ($dh = opendir($uploadDir)) {
            // Baca file satu per satu
            while (($file = readdir($dh)) !== false) {
                // Abaikan direktori '.' dan '..'
                if ($file !== '.' && $file !== '..') {
                    // Dapatkan ekstensi file
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    // Masukkan file ke dalam array jika ekstensi adalah 'txt' atau 'xlsx'
                    if ($ext === 'txt' || $ext === 'xlsx') {
                        $fileList[] = [
                            'name' => $file,
                            'path' => base_url('uploads/' . $file), // URL untuk unduhan
                            'ext' => $ext
                        ];
                    }
                }
            }
            // Tutup direktori
            closedir($dh);
        }
    }

    // Tampilkan view dengan daftar file
    return view('list_files', ['fileList' => $fileList]);
}

public function download($filename)
{
    // Dapatkan jalur lengkap file
    $filePath = WRITEPATH . 'uploads/' . $filename;

    // Periksa apakah file ada
    if (file_exists($filePath)) {
        // Unduh file dengan menggunakan response download
        return $this->response->download($filePath, null)->setFileName($filename);
    } else {
        // File tidak ditemukan, lempar exception PageNotFoundException
        throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
    }
}


public function delete($fileName)
{
    $filePath = WRITEPATH . 'uploads/' . $fileName; // Sesuaikan path jika perlu

    if (file_exists($filePath)) {
        unlink($filePath); // Menghapus file dari sistem
        return redirect()->to(base_url('PrediksiPrice/listUploadedFiles'))->with('message', 'File berhasil dihapus.');
    } else {
        return redirect()->to(base_url('PrediksiPrice/listUploadedFiles'))->with('error', 'File tidak ditemukan.');
    }
}
}
