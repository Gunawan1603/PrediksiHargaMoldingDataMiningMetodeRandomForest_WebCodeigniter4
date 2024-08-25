<?php

namespace App\Controllers;

use App\Models\DataSetModel;
use CodeIgniter\Config\View;
use App\Models\CsvDataset;

class Dataset extends BaseController
{
    public function index()
    {
        $title = "Data Set Mold";
        $link = "datasetmold";
        $model = new DataSetModel();
        $datasetmold = $model->findAll();
        
        return view('datasetmold', compact('datasetmold', 'title', 'link'));
    }

    public function __construct()
    {
        $db = db_connect();
        $this -> DataSetModel = new DataSetModel($db);
    }

    //==========================================================
    //=========================ADD==============================
    //==========================================================
    public function adddataset()
    {
        $title = "Tambah DataSet";
        $link = "dataset/add";
        return view('adddataset', compact('title', 'link'));
    }

    public function save()
    {   
        //$idno = $this->request->getPost('idno');
        $grademold = $this->request->getPost('grade-mold');
        $customer = $this->request->getPost('customer');
        $partapplication = $this->request->getPost('part-application');
        $qtyproduk = $this->request->getPost('qty-produk');
        $Tonase = $this->request->getPost('Tonase');
        $cosmetic = $this->request->getPost('cosmetic');
        // Ganti nama kolom `Resin-plastic` dengan kolom `Resin_plastic`
        $resinplastic = $this->request->getPost('Resin-plastic');
        $cavitymaterial = $this->request->getPost('Cavity-Material');
        $corematerial = $this->request->getPost('Core-Material');
        $slidesystem = $this->request->getPost('Slide-System');
        $liftcoresystem = $this->request->getPost('Lift-Core-System');
        $molddesigntype = $this->request->getPost('Mold-Design-Type');
        $hotrunnersystem = $this->request->getPost('Hot-Runner-System');
        $moldbaseordercompany = $this->request->getPost('Mold-Base-Order-Company');
        $Weight = $this->request->getPost('Weight');
        $pricemold = $this->request->getPost('price-mold');
        $remark = $this->request->getPost('remark');

        $data = [
            'grade-mold' => $grademold,
            'customer' => $customer,
            'part-application' => $partapplication,
            'qty-produk' => $qtyproduk,
            'Tonase' => $Tonase,
            'cosmetic' => $cosmetic,
            'Resin-plastic' => $resinplastic,
            'Cavity-Material' => $cavitymaterial,
            'Core-Material' => $corematerial,
            'Slide-System' => $slidesystem,
            'Lift-Core-System' => $liftcoresystem,
            'Mold-Design-Type' => $molddesigntype,
            'Hot-Runner-System' => $hotrunnersystem,
            'Mold-Base-Order-Company' => $moldbaseordercompany,
            'Weight' => $Weight,
            'price-mold' => $pricemold,
            'remark' => $remark
        ];

        $result = $this->DataSetModel->add($data);
        //if ($result > 0) {
        if ($result !== false) {
            echo ('Data berhasil ditambahkan');
            return redirect()->to(base_url('/dataset'));
        } else {
            echo ('Data gagal ditambahkan');
            return redirect()->to(base_url('/dataset/add'));
        }
    }    

    //============================================================
    //=========================EDIT===============================
    //============================================================

    public function edit($id)
    {
        helper(['form', 'url']);

        $title = "Edit Data Set";
        $link = "datasetmold/edit";

        $DataSetModel = new DataSetModel();

        $data = array(
            'datasetmold' => $DataSetModel->find($id)
        );
        return view('editdataset', compact('data','title', 'link'));
    }

    public function update($id)
    {   
        helper(['form', 'url']);

        $DataSetModel = new DataSetModel();
        $title = "Edit Data Set";
        $link = "datasetmold/edit";
        
        //$idno = $this->request->getPost('idno');
        $grademold = $this->request->getPost('grade-mold');
        $customer = $this->request->getPost('customer');
        $partapplication = $this->request->getPost('part-application');
        $qtyproduk = $this->request->getPost('qty-produk');
        $Tonase = $this->request->getPost('Tonase');
        $cosmetic = $this->request->getPost('cosmetic');
        // Ganti nama kolom `Resin-plastic` dengan kolom `Resin_plastic`
        $resinplastic = $this->request->getPost('Resin-plastic');
        $cavitymaterial = $this->request->getPost('Cavity-Material');
        $corematerial = $this->request->getPost('Core-Material');
        $slidesystem = $this->request->getPost('Slide-System');
        $liftcoresystem = $this->request->getPost('Lift-Core-System');
        $molddesigntype = $this->request->getPost('Mold-Design-Type');
        $hotrunnersystem = $this->request->getPost('Hot-Runner-System');
        $moldbaseordercompany = $this->request->getPost('Mold-Base-Order-Company');
        $Weight = $this->request->getPost('Weight');
        $pricemold = $this->request->getPost('price-mold');
        $remark = $this->request->getPost('remark');

        $data = [
            //'idno'          => $idno,
            'grade-mold' => $grademold,
            'customer' => $customer,
            'part-application' => $partapplication,
            'qty-produk' => $qtyproduk,
            'Tonase' => $Tonase,
            'cosmetic' => $cosmetic,
            'Resin-plastic' => $resinplastic,
            'Cavity-Material' => $cavitymaterial,
            'Core-Material' => $corematerial,
            'Slide-System' => $slidesystem,
            'Lift-Core-System' => $liftcoresystem,
            'Mold-Design-Type' => $molddesigntype,
            'Hot-Runner-System' => $hotrunnersystem,
            'Mold-Base-Order-Company' => $moldbaseordercompany,
            'Weight' => $Weight,
            'price-mold' => $pricemold,
            'remark' => $remark
        ];

            $result = $DataSetModel->update($id, $data);
            //if ($result > 0) {
            if ($result !== false) {
                echo ('Data berhasil diubah');
                return redirect()->to(base_url('/dataset'));
            } else {
                echo ('Data gagal diubah');
                return redirect()->to(base_url('/datasetmold/edit/' . $id));
            }
    }


    //==============================================================
    //=========================DELETE===============================
    //==============================================================
    public function delete($id)
    {
        $DataSetModel = new DataSetModel();
        $title = "Hapus Data Set";
        $link = "datasetmold/delete";

        $datasetmold = $DataSetModel->find($id);

        if($datasetmold){
            $DataSetModel->delete($id);
            echo ('Data berhasil dihapus');
            //return redirect()->to(base_url('/datauser'));
            return redirect()->to('/dataset');
        }
    }


public function insert_csv()
{
    $title = "Import DataSet CSV";
    $link = "dataset/insert_csv";


    // Periksa apakah file CSV kosong sebelum membaca dan memprosesnya
    if (isset($_FILES['file']) && $_FILES['file']['size'] == 0) {
        session()->setFlashdata('message', 'CSV file is empty.');
        session()->setFlashdata('alert-class', 'alert-danger');
        return redirect()->to('/dataset/insert_csv');
    }

    // Jika metode adalah POST, maka lakukan penanganan file CSV
    if ($this->request->getMethod() === 'post') {
        // Validasi input file CSV
        $rules = [
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv]'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan dengan pesan error validasi
            $data['validation'] = $this->validator;
            return view('insert_csv', $data);
        }

        // Jika validasi berhasil, proses file CSV
        $file = $this->request->getFile('file');
        $newName = $file->getRandomName();
        $file->move('../public/csvfile', $newName);

        // Simpan informasi file ke dalam tabel dataset
        $csvModel = new CsvDataset();
        $csvData = [
            'file_name' => $file->getClientName(),
            'file' => $newName,
            'url' => base_url() . '/public/csvfile/' . $newName,
            'is_active' => 1 // Sesuaikan sesuai kebutuhan Anda
        ];
        $csvModel->insert($csvData);

        // Baca file CSV yang telah diunggah
        $file = fopen("../public/csvfile/" . $newName, "r");

        // Array untuk menyimpan data yang akan dimasukkan ke database
        $dataToInsert = [];

        // Baca baris demi baris dari file CSV
        $header = null; // Variabel untuk menyimpan header CSV
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
             // Cek apakah ini adalah baris header
              if ($header === null) {
                  $header = $filedata; // Simpan header
                   continue; // Lanjut ke baris berikutnya
                  }
            // Cek apakah baris mengandung jumlah kolom yang diharapkan
            if (count($filedata) == 17) {
                // Tambahkan data ke array untuk dimasukkan ke database
                $dataToInsert[] = [
                    'grade-mold' => $filedata[0],
                    'customer' => $filedata[1], // Tambah kolom customer
                    'part-application' => $filedata[2], // Tambah kolom part-application
                    'qty-produk' => $filedata[3],
                    'Tonase' => $filedata[4],
                    'Resin-plastic' => $filedata[5], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'cosmetic' => $filedata[6], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Cavity-Material' => $filedata[7], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Core-Material' => $filedata[8], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Slide-System' => $filedata[9], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Lift-Core-System' => $filedata[10], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Mold-Design-Type' => $filedata[11], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Hot-Runner-System' => $filedata[12], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Mold-Base-Order-Company' => $filedata[13], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'Weight' => $filedata[14], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'price-mold' => $filedata[15], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'remark' => $filedata[16], // Kolom ini belum ada di dalam kode, tentunya harus diisi
                    'status' => '' // Misalnya: Jika kolom status tidak ada dalam file CSV
                ];
            }
        }

        // Tutup file CSV
        fclose($file);

        // Memastikan bahwa $dataToInsert tidak kosong sebelum memanggil insertBatch()
        if (!empty($dataToInsert)) {
            // Masukkan data ke database menggunakan model
            $model = new DataSetModel();
            $model->insertBatch($dataToInsert);

            // Tampilkan pesan sukses
            session()->setFlashdata('message', count($dataToInsert) . ' rows successfully added.');
            session()->setFlashdata('alert-class', 'alert-success');

            // Redirect kembali ke halaman dataset
            return redirect()->to('/dataset');
        } else {
            // Jika $dataToInsert kosong, tampilkan pesan kesalahan
            session()->setFlashdata('message', 'No data to insert.');
            session()->setFlashdata('alert-class', 'alert-danger');
            return redirect()->to('/dataset/insert_csv');
        }
    }

    // Tampilkan form untuk mengunggah file CSV
    return view('insert_csv', compact('title', 'link'));
 
}

public function deleteAllData()
{
    $model = new DataSetModel();
    $model->deleteAll(); // Panggil fungsi untuk menghapus semua data
    return redirect()->to('/dataset');
}

public function splitDataset1($percentage)
{
    $model = new DataSetModel();
    $dataset = $model->findAll();

    $totalData = count($dataset);
    $trainingCount = ceil($totalData * $percentage / 100);
    $testingCount = $totalData - $trainingCount;

    shuffle($dataset);

    $trainingSet = array_slice($dataset, 0, $trainingCount);
    $testingSet = array_slice($dataset, $trainingCount, $testingCount);

    // Jika Anda ingin menyimpan training set dan testing set dalam database
    // Anda dapat menambahkan kode berikut

    // Simpan training set ke dalam database
    foreach ($trainingSet as $data) {
        $data['status'] = 'training';
        $model->update($data['id'], $data);
    }

    // Simpan testing set ke dalam database
    foreach ($testingSet as $data) {
        $data['status'] = 'testing';
        $model->update($data['id'], $data);
    }

    // Atau, Anda dapat menyimpannya ke dalam file atau sesuai kebutuhan aplikasi Anda

    // Misalnya, Anda dapat menetapkan ke dalam variabel atau menyimpan dalam session
    $splitData = [
        'trainingSet' => $trainingSet,
        'testingSet' => $testingSet
    ];

    // Kemudian Anda dapat mengirimkannya ke tampilan atau melakukan operasi lainnya sesuai kebutuhan

    // Misalnya:
    return view('splitdataset', compact('splitData', 'percentage'));
}

public function resetStatus()
{
    $model = new DataSetModel();
    $model->resetStatus(); // Panggil fungsi untuk mereset status
    
    // Berikan respons kepada client
    $response = ['status' => 'success']; // Jika berhasil
    echo json_encode($response);
}

public function listCsvFiles()
    {
        $csvModel = new CsvDataset();
        $data['csvFiles'] = $csvModel->findAll();
        $data['title'] = "List of CSV Files"; // Definisikan variabel title

        return view('csvlist/csv_sidebar', $data);
    }

    public function deleteCsvFile($id)
    {
        $csvModel = new CsvDataset();
        $file = $csvModel->find($id);
    
        if ($file) {
            // Hapus file dari server (jika ada)
            $filePath = '../public/csvfile/' . $file['file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
    
            // Hapus data dari database
            $csvModel->delete($id);
    
            session()->setFlashdata('message', 'CSV file berhasil dihapus');
        } else {
            session()->setFlashdata('message', 'CSV file tidak ditemukan');
        }
    
        return redirect()->to('/admin/listCsvFiles');
    }

    public function download($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('dataset'); // Ganti dengan nama tabel yang benar

    // Mengambil data file dari database
    $file = $builder->where('id', $id)->get()->getRowArray();

    if (!$file) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
    }

    // Tentukan path ke file
    $filePath = '../public/csvfile/' . $file['file']; // Sesuaikan path file jika perlu

    // Cek apakah file ada di path yang diberikan
    if (!file_exists($filePath)) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('File does not exist');
    }

    // Download file
    return $this->response->download($filePath, null)
        ->setHeader('Content-Disposition', 'attachment; filename="' . $file['file_name'] . '"');
}    
}
       

