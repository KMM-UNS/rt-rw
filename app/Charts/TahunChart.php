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

class TahunChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $total_wajib22 = 0 + KasIuranWajib::whereYear('tanggal', '2022')->get()->sum('total_biaya');
        $total_agenda22 = 0 + KasIuranAgenda::whereYear('tanggal', '2022')->get()->sum('total_biaya');
        $total_kondisional22 = 0 + KasIuranKondisional::whereYear('tanggal', '2022')->get()->sum('total_biaya');
        $total_sukarela22 = 0 + KasIuranSukaRela::whereYear('tanggal', '2022')->get()->sum('total_biaya');

        $pemasukannn = ManajemenPemasukan::whereYear('created_at', '2022')->get()->sum('nominal');
        $pemasukan22 = $total_agenda22 + $total_wajib22 + $total_kondisional22 + $total_sukarela22 + $pemasukannn;

        $pengeluarannn20 = ManajemenPengeluaran::whereYear('tanggal', '2020')->sum('nominal');
        $pengeluaran20 = 0 + $pengeluarannn20;
        $pengeluarannn21 = ManajemenPengeluaran::whereYear('tanggal', '2021')->sum('nominal');
        $pengeluaran21 = 0 + $pengeluarannn21;
        $pengeluarannn22 = ManajemenPengeluaran::whereYear('tanggal', '2022')->sum('nominal');
        $pengeluaran22 = 0 + $pengeluarannn22;
        $pengeluarannn23 = ManajemenPengeluaran::whereYear('tanggal', '2023')->sum('nominal');
        $pengeluaran23 = 0 + $pengeluarannn23;

        $pemasukann = ManajemenPemasukan::all();
        $pengeluarann = ManajemenPengeluaran::all();
        $saldoo = Saldo::all();
        $saldooo = Saldo::sum('saldo');
        // $pengeluaran = 0 + $pengeluarannn;

        // $saldo =  $saldooo + $total_agenda + $total_wajib + $total_kondisional + $total_sukarela + $pemasukannn - $pengeluarannn;

        return $this->chart->lineChart()
            ->addData('Pemasukan', [40, 93, $pemasukan22, 45])
            ->addData('Pengeluaran', [$pengeluaran20, $pengeluaran21, $pengeluaran22, $pengeluaran23])
            ->setXAxis(['2020', '2021', '2022', '2023']);
    }
}
