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

class KasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $total_wajib = 0 + KasIuranWajib::sum('total_biaya');
        $total_agenda = 0 + KasIuranAgenda::sum('total_biaya');
        $total_kondisional = 0 + KasIuranKondisional::sum('total_biaya');
        $total_sukarela = 0 + KasIuranSukaRela::sum('total_biaya');
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
            ->addData([$total_wajib, $total_agenda, $total_kondisional, $total_sukarela])
            ->setLabels(['Kas Iuran Wajib', 'Kas Iuran Agenda', 'Kas Iuran Kondisional', 'Kas Iuran Sukarela']);
        // ->setTitle('Grafik Dana Pemasukan')
        // ->setSubtitle('Periode 2022')
        // ->addData([$total_wajib, $total_agenda, $total_kondisional, $total_sukarela])
        // ->setLabels(['Total Kas Iuran Wajib', 'Total Kas Iuran Agenda', 'Total Kas Iuran Kondisional', 'Total Kas Iuran Sukarela']);
    }
}
