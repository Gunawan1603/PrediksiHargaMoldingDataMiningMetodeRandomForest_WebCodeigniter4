<?php

namespace App\Controllers;

use App\Models\DataSetModel;
use CodeIgniter\Config\View;

class DatasetUser extends BaseController
{
    public function index()
    {
        $title = "Data Set Mold";
        $link = "datasetmolduser";
        $model = new DataSetModel();
        $datasetmold = $model->findAll();
        
        return view('datasetmolduser', compact('datasetmold', 'title', 'link'));
    }

    public function __construct()
    {
        $db = db_connect();
        $this -> DataSetModel = new DataSetModel($db);
    }

    //==========================================================
    //=========================ADD==============================
    //==========================================================
    public function adddatasetuser()
    {
        $title = "Tambah Data Set";
        $link = "datasetuser/add";
        return view('adddatasetuser', compact('title', 'link'));
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
            return redirect()->to(base_url('datasetuser'));
        } else {
            echo ('Data gagal ditambahkan');
            return redirect()->to(base_url('/datasetuser/add'));
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
        return view('editdatasetuser', compact('data','title', 'link'));
    }

    public function update($id)
    {   
        helper(['form', 'url']);

        $DataSetModel = new DataSetModel();
        $title = "Edit Data Set";
        $link = "datasetmolduser/edit";
        
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
                return redirect()->to(base_url('/user/datasetuser'));
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
            return redirect()->to('user/datasetuser');
        }
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


}
