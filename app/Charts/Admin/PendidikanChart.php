<?php

namespace App\Charts\Admin;

use App\Models\Warga;
use App\Models\Pendidikan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PendidikanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $pendidikanLabel = Pendidikan::pluck('nama')->toArray();
        $pendidikans = Pendidikan::pluck('id')->toArray();
        $data = array();
        foreach($pendidikans as $pendidikan)
        {
            $x = Warga::where('pendidikan_id', $pendidikan)->count();
            array_push($data, $x);
        }
        $result = array_values($data);
        return $this->chart->pieChart()
            ->setTitle('Grafik Pendidikan')
            ->addData($result)
            ->setFontFamily('Open Sans')
            ->setLabels($pendidikanLabel);
    }
}
