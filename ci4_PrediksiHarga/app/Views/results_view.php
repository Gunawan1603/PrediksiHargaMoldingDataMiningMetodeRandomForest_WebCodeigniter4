<?= $this->include('template/headerforcontent'); ?>

<div class="container">
    <h3>Persentase Input data set</h3>
    <div class="alert alert-info" role="alert">
        Trainingset: 
        <?php 
        $file = WRITEPATH . 'persentase_input.txt';
        if (file_exists($file)) {
            $percentage = intval(file_get_contents($file));
            $percentageTesting = 100 - $percentage;
            echo htmlspecialchars($percentage) . '%';
        } else {
            echo 'N/A';
            $percentageTesting = 'N/A';
        }
        ?> 
        dan Testingset: <?= htmlspecialchars($percentageTesting) ?>%
    </div>

    <h2>Hasil Performa</h2>
    <div class="alert alert-info" role="alert">
        Akurasi: 
        <?php 
        $accuracy = session()->get('accuracy', 'N/A');
        if (is_array($accuracy)) {
            echo htmlspecialchars(json_encode($accuracy));
        } elseif (is_numeric($accuracy)) {
            echo htmlspecialchars(number_format($accuracy * 100, 2) . '%');
        } else {
            echo htmlspecialchars($accuracy);
        }
        ?>
    </div>

    <?php if (isset($classificationReport)): ?>
        <div class="card">
            <div class="card-header">
                Laporan Klasifikasi
            </div>
            <div class="card-body">
                <?php
                function format_classification_report($report) {
                    $html = '<table class="table table-bordered">';
                    $html .= '<thead><tr><th>Label</th><th>Precision</th><th>Recall</th><th>F1-Score</th><th>Support</th></tr></thead><tbody>';
                    foreach ($report as $label => $metrics) {
                        if (is_array($metrics)) {
                            $html .= '<tr>';
                            $html .= '<td>' . htmlspecialchars($label) . '</td>';
                            $html .= '<td>' . htmlspecialchars(number_format($metrics['precision'] * 100, 2) . '%') . '</td>';
                            $html .= '<td>' . htmlspecialchars(number_format($metrics['recall'] * 100, 2) . '%') . '</td>';
                            $html .= '<td>' . htmlspecialchars(number_format($metrics['f1-score'] * 100, 2) . '%') . '</td>';
                            $html .= '<td>' . htmlspecialchars($metrics['support']) . '</td>';
                            $html .= '</tr>';
                        }
                    }
                    $html .= '</tbody></table>';
                    return $html;
                }
                echo format_classification_report($classificationReport);
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($mae) && isset($mape)): ?>
        <div class="card mt-3">
            <div class="card-header">
                Laporan MAE dan MAPE
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Metode</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mean Absolute Error (MAE)</td>
                            <td><?= htmlspecialchars(number_format($mae, 2)) ?></td>
                        </tr>
                        <tr>
                            <td>Mean Absolute Percentage Error (MAPE)</td>
                            <td><?= htmlspecialchars(number_format($mape, 2)) ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="text-right mt-3">
        <a href="<?= base_url('splitdataset') ?>" class="btn btn-primary">Kembali ke Split Data Set</a>
    </div>
</div>

<?= $this->include('template/footerforcontent'); ?>
