
<style>
    .table-horizontal th,
    .table-horizontal td {
        text-align: center;
    }

    .table-horizontal th:first-child,
    .table-horizontal td:first-child {
        text-align: left;
    }

    /* Menyesuaikan ukuran card dan chart */
    .card {
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .card-block {
        padding: 10px; /* Mengurangi padding agar lebih kecil */
    }

    .card-title {
        margin-bottom: 0;
        font-size: 16px; /* Mengurangi ukuran font judul card */
    }

    /* Menyesuaikan ukuran chart */
    canvas {
        max-width: 100%;
        height: auto;
    }
</style>

<div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->

                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue">
                                                                    <?php $db      = \Config\Database::connect();
                                                                    $db = db_connect();
                                                                    
                                                                    $querydatasetmold = $db->query("select count(*) as jumlahdatasetmold from datasetmold");
                                                                    $datadatasetmold = $querydatasetmold->getResultArray();
                                                                    echo $datadatasetmold[0]['jumlahdatasetmold']; ?> Set
                                                                    
                                                                </h4>
                                                                <h6 class="text-muted m-b-0">Jumlah Data Set Mold</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa-solid fa-3x fa-cloud"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="card-footer bg-c-yellow">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0"><i>Updated data.</i></p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="fa fa-line-chart text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <!-- <h4 class="text-c-red">Gunawan</h4> -->
                                                                <h4 class="text-c-red"> <a href=""> Hi, <?=userLogin()->user_name?> <i class="ti-user"> </i> </h4>
                                                                <!-- <h6 class="text-muted m-b-0">312010191</h6> -->
                                                                <h6 class="text-c-red"> <a href=""> <?=userLogin()->role?> <i class="ti-home"> </i> </h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="fa fa-calendar-check-o f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Link : <a href=" " style="color: white"> </a></p>
                                                        </div>                                                           
                                                    </div>
                                                </div>
                                             </div>
                                          </div>
    <!-- Page-body start -->
    <div class="page-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Grafik Atribut Dataset Mold</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="charts-container">
        <!-- Grafik akan dimasukkan ke sini -->
    </div>
</div>

<!-- Pastikan library Chart.js dimuat terlebih dahulu -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
// Fungsi untuk menghitung jumlah nilai yang dapat dihitung (string atau integer)
function filter_countable_values($array) {
    return array_filter($array, function($value) {
        return is_string($value) || is_int($value);
    });
}

// Query untuk mengambil data dari tabel datasetmold
$db = \Config\Database::connect();
$query = $db->query("SELECT `grade-mold`, `customer`, `part-application`, `qty-produk`, `Tonase`, `Resin-plastic`, `cosmetic`, `Cavity-Material`, `Core-Material`, `Slide-System`, `Lift-Core-System`, `Mold-Design-Type`, `Hot-Runner-System`, `Mold-Base-Order-Company`, `Weight`, `price-mold`, `remark`, `status` FROM datasetmold");
$results = $query->getResultArray();

if (empty($results)) {
    $attributes = [];
    $attributeCounts = [];
} else {
    $attributes = array_keys($results[0]);

    // Menghitung jumlah setiap nilai untuk setiap atribut
    $attributeCounts = array_map(function($attribute) use ($results) {
        $columnValues = array_column($results, $attribute);
        $filteredValues = filter_countable_values($columnValues);
        return array_count_values($filteredValues);
    }, $attributes);
}

// Debugging: Memeriksa apakah data sudah di-set dengan benar
echo '<!-- Attributes: ' . htmlspecialchars(json_encode($attributes)) . ' -->';
echo '<!-- AttributeCounts: ' . htmlspecialchars(json_encode($attributeCounts)) . ' -->';
?>

<script>
    //Data dari PHP yang akan digunakan untuk membuat chart
    var attributes = <?= json_encode($attributes) ?>;
    var attributeCounts = <?= json_encode($attributeCounts) ?>;

    var colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(199, 199, 199, 0.2)',
        'rgba(83, 102, 255, 0.2)',
        'rgba(99, 255, 86, 0.2)',
        'rgba(255, 202, 64, 0.2)',
        'rgba(192, 75, 192, 0.2)',
        'rgba(255, 153, 64, 0.2)',
        'rgba(102, 102, 255, 0.2)',
        'rgba(255, 99, 255, 0.2)',
        'rgba(64, 199, 64, 0.2)',
        'rgba(255, 199, 64, 0.2)',
        'rgba(64, 102, 199, 0.2)',
        'rgba(255, 199, 199, 0.2)'
    ];

    var borderColors = colors.map(color => color.replace('0.2', '1'));

    // Function to create chart dynamically
    function createChart(container, attribute, data, color, borderColor) {
        var colDiv = document.createElement('div');
        colDiv.className = 'col-lg-6 mb-4'; // Adjust columns as needed for 2 columns horizontally
        container.appendChild(colDiv);

        var card = document.createElement('div');
        card.className = 'card';
        colDiv.appendChild(card);

        var cardBlock = document.createElement('div');
        cardBlock.className = 'card-block p-2'; // Adjust padding to make it smaller
        card.appendChild(cardBlock);

        var canvas = document.createElement('canvas');
        var canvasId = attribute.replace(/\s+/g, '-').toLowerCase(); // Buat ID canvas berdasarkan atribut
        canvas.id = canvasId; // Set ID untuk elemen canvas
        cardBlock.appendChild(canvas);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    label: attribute,
                    data: Object.values(data),
                    backgroundColor: color,
                    borderColor: borderColor,
                    borderWidth: 1 // Make border thinner
                }]
            },
            options: {
                indexAxis: 'y', // Change to 'y' for horizontal bar chart
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y.toLocaleString();
                                }
                                return label;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 8 // Adjust font size here
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 8 // Adjust font size here
                            }
                        }
                    }
                }
            }
        });
    }

    window.onload = function() {
        var container = document.getElementById('charts-container');
        if (attributes.length > 0 && attributeCounts.length > 0) {
            attributes.forEach((attribute, index) => {
                createChart(container, attribute, attributeCounts[index], colors[index % colors.length], borderColors[index % borderColors.length]);
            });
        } else {
            console.log('No data available to display charts.');
        }
    }
</script>