<?php

/**
 *
 */

enum Jenis: int
{
  case BENEFIT = 1;
  case COST = 0;
}

class SAW
{

  public $alternatif = [];
  public $KriteriaTernormalisasi = [];
  function __construct()
  {
  }
  public function setAlternatif($alternatif)
  {
    if (!empty($alternatif)) {
      $this->alternatif = $alternatif;
    }
  }
  public function getAlternatif()
  {
    return $this->alternatif;
  }

  public function setKriteria($Kriteria)
  {
    $Kriteria = array_change_key_case($Kriteria, CASE_LOWER);

    $KriteriaTernormalisasi = array_map(function ($val) use ($Kriteria) {
      return $val / array_sum($Kriteria);
    }, $Kriteria);
    //jika Kriteria == 1 
    //jika tidak error ngab
    if (array_sum($KriteriaTernormalisasi) == 1) {
      $this->KriteriaTernormalisasi = $KriteriaTernormalisasi;
      return;
    }
    throw new Exception("Kriteria harus bernilai = 1");
  }
  public function sumKriteria()
  {
    return array_sum($this->KriteriaTernormalisasi);
  }
  public function getKriteria()
  {
    return $this->KriteriaTernormalisasi;
  }
  public function normalisasi()
  {
    $pembagi = $this->getPembagi();
    $data = [];
    foreach ($this->alternatif as $key => $val) {
      foreach ($val as $k1 => $v1) {
        if ($v1['jenis'] === Jenis::BENEFIT) {
          $data[$key][$k1] = ($v1['nilai'] / $pembagi[$k1]);
        } else {
          $data[$key][$k1] = ($pembagi[$k1] / $v1['nilai']);
        }
      }
    }
    return $data;
  }
  public function getNormalisasi()
  {
    return $this->normalisasi();
  }
  public function getPembagi()
  {
    $data = [];
    foreach ($this->alternatif as $key => $val) {
      foreach ($val as $k1 => $v1) {
        if ($v1['jenis'] === Jenis::BENEFIT) {
          $data[$k1] = max(array_column(array_column($this->alternatif, $k1), 'nilai'));
        } else {
          $data[$k1] = min(array_column(array_column($this->alternatif, $k1), 'nilai'));
        }
      }
    }
    return $data;
  }
}
