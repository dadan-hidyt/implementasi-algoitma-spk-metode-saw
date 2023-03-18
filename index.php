<?php
include 'saw.php';
$saw = new Saw();


$bobot = array(
    'nilai' => 90,
    'nilai_sikap' => 90,
    'nilai_pkn' => 90,
    'gaji_ortu' => 1000000,
    'minat_programing' =>90,
);

$alternatifData = [
    '3824324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 80,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 31,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 2,
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
    '38224324' => [
        'nilai' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 90,
        ],
        'nilai_sikap' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 31,
        ],
        'nilai_pkn' => [
            'jenis' => Jenis::BENEFIT,
            'nilai' => 2,
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <?php foreach ($saw->getPembagi() as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>
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
                       
                    </tr>
                <?php endforeach; ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h3>Hasil Perangkingan: </h3>
        <p class="text-info"><i>Nilai di atas 70 Adalah siswa yang lulus seleksi</i></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                   
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($saw->hitungSaw() as $key => $val) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $val; ?></td>
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