<?php

namespace App\Charts;

use App\Models\KasIuranAgenda;
use App\Models\KasIuranKondisional;
use App\Models\KasIuranSukaRela;
use App\Models\KasIuranWajib;
use App\Models\ManajemenPemasukan;
use App\Models\ManajemenPengeluaran;
use App\Models\Saldo;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KeuanganChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $total_wajib = KasIuranWajib::sum('total_biaya');
        $total_agenda = KasIuranAgenda::sum('total_biaya');
        $total_kondisional = KasIuranKondisional::sum('total_biaya');
        $total_sukarela = KasIuranSukaRela::sum('total_biaya');
        $pemasukannn = ManajemenPemasukan::sum('nominal');
        $pengeluarannn = ManajemenPengeluaran::sum('nominal');
        $pemasukann = ManajemenPemasukan::all();
        $pengeluarann = ManajemenPengeluaran::all();
        $saldoo = Saldo::all();
        $saldooo = Saldo::sum('saldo');
        $pengeluaran = 0 + $pengeluarannn;
        $pemasukan = $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn;
        $saldo =  $saldooo + $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn - $pengeluarannn;


        return $this->chart->pieChart()
            ->addData([$pengeluaran, $pemasukan])
            ->setLabels(['Pengeluaran', 'Pemasukan']);
    }
}
