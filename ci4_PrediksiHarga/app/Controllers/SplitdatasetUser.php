<?php

namespace App\Controllers;

use App\Models\DataSetModel;
use App\Models\TrainingSetModel;
use App\Models\TestingSetModel;

class SplitdatasetUser extends BaseController
{
    private $DataSetModel;
    private $TrainingSetModel;
    private $TestingSetModel;

    public function __construct()
    {
        $db = db_connect();
        $this->DataSetModel = new DataSetModel($db);
        $this->TrainingSetModel = new TrainingSetModel();
        $this->TestingSetModel = new TestingSetModel();
    }

    public function index()
    {
        $trainingSet = $this->DataSetModel->where('status', 'training')->findAll();
        $testingSet = $this->DataSetModel->where('status', 'testing')->findAll();
        $datasetmold = $this->DataSetModel->findAll();
        $title = "Pemisahan Data Set Mold";
        $link = "datasetmold";

        return view('splitdatasetuser', compact('title', 'link', 'datasetmold', 'trainingSet', 'testingSet'));
    }

    public function splitPersen()
    {
        $percentage = intval($this->request->getPost('percentageInput'));
        
        if ($percentage > 0 && $percentage <= 100) { // validasi tambahan
            // Simpan nilai persentase input ke dalam file teks
            $file = WRITEPATH . 'persentase_input.txt'; // Sesuaikan dengan path yang sesuai di aplikasi Anda
            if (!is_dir(WRITEPATH)) {
                mkdir(WRITEPATH, 0777, true);
            }
            file_put_contents($file, $percentage);

            // Panggil method split() atau method lainnya untuk memproses data sesuai kebutuhan Anda
            $this->split($percentage);

            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }


    private function split($percentage)
    {
        $datasetmold = $this->DataSetModel->findAll();
        $totalData = count($datasetmold);
        $trainingCount = ceil($totalData * $percentage / 100);
        $testingCount = $totalData - $trainingCount;

        shuffle($datasetmold);

        $trainingSet = array_slice($datasetmold, 0, $trainingCount);
        $testingSet = array_slice($datasetmold, $trainingCount, $testingCount);

        foreach ($trainingSet as $data) {
            $data['status'] = 'training';
            $this->DataSetModel->save($data);
            unset($data['id']);
            $this->TrainingSetModel->insert($data);
        }

        foreach ($testingSet as $data) {
            $data['status'] = 'testing';
            $this->DataSetModel->save($data);
            unset($data['id']);
            $this->TestingSetModel->insert($data);
        }
    }

    public function resetStatus()
   {
    try {
        // Reset status in the database
        $this->DataSetModel->set(['status' => null])->update();
        
        // Delete training and testing set data
        $this->deleteAllData();
        
        // Clear the percentage input file
        $file = WRITEPATH . 'persentase_input.txt';
        if (file_exists($file)) {
            file_put_contents($file, ''); // Empty the file
        }

        return $this->response->setJSON(['status' => 'success']);
    } catch (\Exception $e) {
        return $this->response->setJSON(['status' => 'error']);
    }
    }

    public function deleteAllData()
    {
        try {
            $this->TrainingSetModel->truncate();
            $this->TestingSetModel->truncate();
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function performance()
    {
    $percentage = $this->request->getPost('percentageInput');
    if ($percentage) {
        $result = $this->calculatePerformance($percentage);
        session()->set('accuracy', $result['accuracy']);
        session()->set('classification_report', $result['classification_report']);
        session()->set('mae', $result['MAE']);
        session()->set('mape', $result['MAPE']);
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Input persentase tidak valid']);
    }
    }


    private function calculatePerformance($percentage)
    {
        $pythonScript = APPPATH . 'Python/performance.py';
        $output = $this->runPythonScript($pythonScript, $percentage);
        return $output;
    }

    private function runPythonScript($scriptPath, $percentage)
    {
    $command = escapeshellcmd("python $scriptPath $percentage");
    $output = shell_exec($command);
    return json_decode($output, true);
    }

    public function showResults()
    {
    $accuracy = session()->get('accuracy');
    $classificationReport = session()->get('classification_report');
    $mae = session()->get('mae', 'N/A');
    $mape = session()->get('mape', 'N/A');
    return view('results_viewuser', ['accuracy' => $accuracy, 'classificationReport' => $classificationReport,
        'mae' => $mae,
        'mape' => $mape]);
    }

    public function resultsView()
    {
        return view('results_viewuser');
    }
}
