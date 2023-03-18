<?php

class Saw
{
    private $bobotKriteria = [];
    private $dataAlternatif = [];
    public $costKeyword = ['harga'];
    public $benefitKeyword = ['kualitas', 'kepopuleran'];
    public function setBobotKriteria(array $bobotKriteria): void
    {
        $this->bobotKriteria = $this->_normalisasiBobotKritera($bobotKriteria);
    }
    private function _normalisasiBobotKritera($data)
    {
        return array_map(function ($value) use ($data) {
            return $value / array_sum($data);
        }, $data);
    }
    public function getMinMax()
    {
        $dataAlternatif = $this->getDataAlternatif();
        $data = [];
        foreach ($dataAlternatif as $key => $val) {
            foreach ($this->costKeyword as $ck) {
                if (isset($val[$ck])) {
                    $data[$ck] = min(array_column($dataAlternatif, $ck));
                }
            }
            foreach ($this->benefitKeyword as $bk) {
                $data[$bk] = max(array_column($dataAlternatif, $bk));
            }
        }
        return $data;
    }

    public function normalisasi()
    {
        $minmax = $this->getMinMax();
        $data = [];
        foreach ($this->dataAlternatif as $key => $value) {
            foreach ($value as $key1 => $val1) {
                if (in_array($key1, $this->costKeyword)) {
                    $this->dataAlternatif[$key][$key1] = ($minmax[$key1] / $val1);
                } else {
                    if(in_array($key1,$this->benefitKeyword)) {
                        $this->dataAlternatif[$key][$key1] = ($val1 / $minmax[$key1]); 
                    }
                }
            }
        }
        return $this->dataAlternatif;
    }
    
    public function getBobotKriteria()
    {
        return $this->bobotKriteria;
    }
    public function setDataAlternatif(array $dataAlternatif): void
    {
        $this->dataAlternatif = $dataAlternatif;
    }
    public function getDataAlternatif(): array
    {
        return $this->dataAlternatif;
    }
    public function countRatings(){
        $dataAlternatif = $this->normalisasi();
        $data = [];
        foreach($dataAlternatif as $da) {
            $data[$da['nama']] = 0;
            foreach($da as $k1 => $v1) {
                if(in_array($k1, $this->costKeyword) OR in_array($k1,$this->benefitKeyword)){
                    $data[$da['nama']] +=  ($this->getBobotKriteria()[$k1] * $v1);
                }
            }
        }
        return $data;
    }
}

$saw = new Saw();

$saw->setDataAlternatif([
    [
        'nama' => 'Samsung j2 prime',
        'harga' => 1000000,
        'kualitas' => 60,
        'kepopuleran' => 70,
    ],
    [
        'nama' => 'Advan a5s',
        'harga' => 1200000,
        'kualitas' => 90,
        'kepopuleran' => 20,
    ],
    [
        'nama' => 'Iphone 10',
        'harga' => 12000000,
        'kualitas' => 90,
        'kepopuleran' => 50,
    ],
    [
        'nama' => 'SPC S9',
        'harga' => 600000,
        'kualitas' => 80,
        'kepopuleran' => 80,
    ],
]);
$saw->setBobotKriteria([
    'harga' => 50,
    'kualitas' => 90,
    'kepopuleran' => 50,
]);
$hasilAkhir = $saw->countRatings();
array_multisort($hasilAkhir, SORT_DESC);
header('Content-Type:application/json');

echo json_encode($hasilAkhir,JSON_PRETTY_PRINT);
