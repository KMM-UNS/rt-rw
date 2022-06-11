<?php

namespace App\Charts\Admin;

use App\Models\Warga;
use App\Models\Pekerjaan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PekerjaanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $pekerjaanLabel = Pekerjaan::pluck('nama')->toArray();
        $pekerjaans = Pekerjaan::pluck('id')->toArray();
        $data = array();
        foreach($pekerjaans as $pekerjaan)
        {
            $x = Warga::where('pekerjaan_id', $pekerjaan)->count();
            array_push($data, $x);
        }
        $result = array_values($data);
        return $this->chart->pieChart()
            ->setTitle('Grafik Pendidikan')
            ->addData($result)
            ->setFontFamily('Open Sans')
            ->setLabels($pekerjaanLabel);
    }
}
