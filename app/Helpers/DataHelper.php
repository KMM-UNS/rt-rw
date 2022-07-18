<?php

namespace App\Helpers;

class DataHelper
{
  public static function nomorRomawiDropdownData()
  {
    $arr = [];

    $arr['I'] = 'I';
    $arr['II'] = 'II';
    $arr['III'] = 'III';
    $arr['IV'] = 'IV';
    $arr['V'] = 'V';
    $arr['VI'] = 'VI';
    $arr['VII'] = 'VII';
    $arr['VIII'] = 'VIII';
    $arr['IX'] = 'IX';
    $arr['X'] = 'X';
    $arr['XI'] = 'XI';
    $arr['XII'] = 'XII';

    return $arr;
  }

  public static function monthDropdownData()
  {
    $arr = [];

    $arr['01'] = 'Januari';
    $arr['02'] = 'Februari';
    $arr['03'] = 'Maret';
    $arr['04'] = 'April';
    $arr['05'] = 'Mei';
    $arr['06'] = 'Juni';
    $arr['07'] = 'Juli';
    $arr['08'] = 'Agustus';
    $arr['09'] = 'September';
    $arr['10'] = 'Oktober';
    $arr['11'] = 'November';
    $arr['12'] = 'Desember';

    return $arr;
  }

  public static function yearDropdownData(int $minYear = 1990)
  {
    $arr = [];

    $thn_skr = date('Y');

    for ($thn = $thn_skr; $thn >= $minYear; $thn--) :
      $arr[$thn] = $thn;
    endfor;

    return $arr;
  }



  public static function filterDokumenData($data, string $params = null, string $value = null, string $operator = '==')
  {
    try {
      $data = collect($data);
      $filtered = $data->filter(function ($row, $key) use ($params, $value, $operator) {
        return eval("return \"" . data_get($row, $params) . "\" " . $operator . " \"" . $value . "\";");
      });

      return $filtered;
    } catch (\Throwable $th) {
      return $th;
    }
  }
}
