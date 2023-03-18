<?php
include 'saw.php';
$saw = new Saw();


$bobot = array(
    'nilai' => 10,
    'nilai_sikap' => 50,
    'nilai_pkn' => 70,
    'gaji_ortu' => 1000,
    'minat_programing' => 50,
);

$alternatifData = [
    '3824324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 85,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 87,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 89,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 200000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 80,
        ]
    ],
    '3824325' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 82,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 78,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 68,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 4000000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 50,
        ]
    ],
    '3824524' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 91,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 92,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 83,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 4000000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 60,
        ]
    ],
    '3324324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 90,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 95,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 80,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 4000000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 50,
        ]
    ],
    '824324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 90,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 95,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 80,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 4000000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 70,
        ]
    ],
    '824324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 50,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 35,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 20,
        ],
        'gaji_ortu' => [
            'jenis' => Jenis::COST,
            'nilai' => 1000000,
        ],
        'minat_programing' =>  [
            'jenis' => Jenis::COST,
            'nilai' => 60,
        ]
    ],
 
];
$saw->setAlternatif($alternatifData);
$saw->setKriteria($bobot);
$saw->getPembagi();


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1 class='text-center m-4'>IMPLEMENTASI METODE SAW!</h1>
    <hr>
    <div class="container">
        <h3>Alternatif Data: </h3>
        <table class="table table-bordered">
            <thead>
                <th>Nama</th>
                <?php foreach ($saw->getKriteria() as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach; ?>
            </thead>
            <tbody>
                <?php foreach ($saw->getAlternatif() as $key => $val) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <?php foreach ($val as $key => $val) : ?>
                            <td><?= $val['nilai'] ?> <?= Jenis::BENEFIT === $val['jenis'] ? 'B' : 'C'; ?> </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h3>Kriteria Data: </h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kepentingan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saw->getKriteria() as $key => $val) : $count = array_sum($saw->getKriteria()) ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $val ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><?= $count ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h3>Pembagi: </h3>
        <table class="table table-bordered">
            <thead>
                <?php foreach ($saw->getPembagi() as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach; ?>
            </thead>
            <tbody>
                <tr>

                    <?php foreach ($saw->getPembagi() as $key => $val) : ?>
                        <td><?= $val; ?></td>
                    <?php endforeach; ?>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="container">
        <h3>Hasil Normalisasi: </h3>
        <p class="text-info"><i>Nilai di atas 70 Adalah siswa yang lulus seleksi</i></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <?php foreach ($saw->getPembagi() as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saw->getNormalisasi() as $key => $val) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <?php foreach ($val as $key => $val) : $total = 0; ?>
                            <?php $total += $val; ?>
                            <td><?= $val ?> </td>
                        <?php endforeach; ?>
                        <?php if ($total > 0.70) : ?>
                            <td class="text-white bg-success"><?= $total; ?></td>
                        <?php else : ?>
                            <td class="text-white bg-danger"><?= $total; ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <tr></tr>
            </tbody>
        </table>
    </div>

    <div class="mb-4"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>