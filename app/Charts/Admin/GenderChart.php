<?php

namespace App\Charts\Admin;

use App\Models\Pendidikan;
use App\Models\Warga;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        return $this->chart->pieChart()
            ->addData([
                Warga::where('jenis_kelamin', 'laki-laki')->count(),
                Warga::where('jenis_kelamin', 'perempuan')->count(),
            ])
            ->setFontFamily('Open Sans')
            ->setLabels(['Laki-laki', 'Perempuan']);
    }
}
