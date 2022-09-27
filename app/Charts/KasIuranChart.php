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

class KasIuranChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $total_wajib1 = 0 + KasIuranWajib::whereMonth('tanggal', '01')->get()->sum('total_biaya');
        $total_wajib2 = 0 + KasIuranWajib::whereMonth('tanggal', '02')->get()->sum('total_biaya');
        $total_wajib3 = 0 + KasIuranWajib::whereMonth('tanggal', '03')->get()->sum('total_biaya');
        $total_wajib4 = 0 + KasIuranWajib::whereMonth('tanggal', '04')->get()->sum('total_biaya');
        $total_wajib5 = 0 + KasIuranWajib::whereMonth('tanggal', '05')->get()->sum('total_biaya');
        $total_wajib6 = 0 + KasIuranWajib::whereMonth('tanggal', '06')->get()->sum('total_biaya');
        $total_wajib7 = 0 + KasIuranWajib::whereMonth('tanggal', '07')->get()->sum('total_biaya');
        $total_wajib8 = 0 + KasIuranWajib::whereMonth('tanggal', '08')->get()->sum('total_biaya');
        $total_wajib9 = 0 + KasIuranWajib::whereMonth('tanggal', '09')->get()->sum('total_biaya');
        $total_wajib10 = 0 + KasIuranWajib::whereMonth('tanggal', '10')->get()->sum('total_biaya');
        $total_wajib11 = 0 + KasIuranWajib::whereMonth('tanggal', '11')->get()->sum('total_biaya');
        $total_wajib12 = 0 + KasIuranWajib::whereMonth('tanggal', '12')->get()->sum('total_biaya');

        $total_sukarela1 = 0 + KasIuranSukaRela::whereMonth('tanggal', '01')->get()->sum('total_biaya');
        $total_sukarela2 = 0 + KasIuranSukaRela::whereMonth('tanggal', '02')->get()->sum('total_biaya');
        $total_sukarela3 = 0 + KasIuranSukaRela::whereMonth('tanggal', '03')->get()->sum('total_biaya');
        $total_sukarela4 = 0 + KasIuranSukaRela::whereMonth('tanggal', '04')->get()->sum('total_biaya');
        $total_sukarela5 = 0 + KasIuranSukaRela::whereMonth('tanggal', '05')->get()->sum('total_biaya');
        $total_sukarela6 = 0 + KasIuranSukaRela::whereMonth('tanggal', '06')->get()->sum('total_biaya');
        $total_sukarela7 = 0 + KasIuranSukaRela::whereMonth('tanggal', '07')->get()->sum('total_biaya');
        $total_sukarela8 = 0 + KasIuranSukaRela::whereMonth('tanggal', '08')->get()->sum('total_biaya');
        $total_sukarela9 = 0 + KasIuranSukaRela::whereMonth('tanggal', '09')->get()->sum('total_biaya');
        $total_sukarela10 = 0 + KasIuranSukaRela::whereMonth('tanggal', '10')->get()->sum('total_biaya');
        $total_sukarela11 = 0 + KasIuranSukaRela::whereMonth('tanggal', '11')->get()->sum('total_biaya');
        $total_sukarela12 = 0 + KasIuranSukaRela::whereMonth('tanggal', '12')->get()->sum('total_biaya');

        $total_kondisional1 = 0 + KasIurankondisional::whereMonth('tanggal', '01')->get()->sum('total_biaya');
        $total_kondisional2 = 0 + KasIurankondisional::whereMonth('tanggal', '02')->get()->sum('total_biaya');
        $total_kondisional3 = 0 + KasIurankondisional::whereMonth('tanggal', '03')->get()->sum('total_biaya');
        $total_kondisional4 = 0 + KasIurankondisional::whereMonth('tanggal', '04')->get()->sum('total_biaya');
        $total_kondisional5 = 0 + KasIurankondisional::whereMonth('tanggal', '05')->get()->sum('total_biaya');
        $total_kondisional6 = 0 + KasIurankondisional::whereMonth('tanggal', '06')->get()->sum('total_biaya');
        $total_kondisional7 = 0 + KasIurankondisional::whereMonth('tanggal', '07')->get()->sum('total_biaya');
        $total_kondisional8 = 0 + KasIurankondisional::whereMonth('tanggal', '08')->get()->sum('total_biaya');
        $total_kondisional9 = 0 + KasIurankondisional::whereMonth('tanggal', '09')->get()->sum('total_biaya');
        $total_kondisional10 = 0 + KasIurankondisional::whereMonth('tanggal', '10')->get()->sum('total_biaya');
        $total_kondisional11 = 0 + KasIurankondisional::whereMonth('tanggal', '11')->get()->sum('total_biaya');
        $total_kondisional12 = 0 + KasIurankondisional::whereMonth('tanggal', '12')->get()->sum('total_biaya');

        $total_agenda1 = 0 + KasIuranagenda::whereMonth('tanggal', '01')->get()->sum('total_biaya');
        $total_agenda2 = 0 + KasIuranagenda::whereMonth('tanggal', '02')->get()->sum('total_biaya');
        $total_agenda3 = 0 + KasIuranagenda::whereMonth('tanggal', '03')->get()->sum('total_biaya');
        $total_agenda4 = 0 + KasIuranagenda::whereMonth('tanggal', '04')->get()->sum('total_biaya');
        $total_agenda5 = 0 + KasIuranagenda::whereMonth('tanggal', '05')->get()->sum('total_biaya');
        $total_agenda6 = 0 + KasIuranagenda::whereMonth('tanggal', '06')->get()->sum('total_biaya');
        $total_agenda7 = 0 + KasIuranagenda::whereMonth('tanggal', '07')->get()->sum('total_biaya');
        $total_agenda8 = 0 + KasIuranagenda::whereMonth('tanggal', '08')->get()->sum('total_biaya');
        $total_agenda9 = 0 + KasIuranagenda::whereMonth('tanggal', '09')->get()->sum('total_biaya');
        $total_agenda10 = 0 + KasIuranagenda::whereMonth('tanggal', '10')->get()->sum('total_biaya');
        $total_agenda11 = 0 + KasIuranagenda::whereMonth('tanggal', '11')->get()->sum('total_biaya');
        $total_agenda12 = 0 + KasIuranagenda::whereMonth('tanggal', '12')->get()->sum('total_biaya');

        return $this->chart->barChart()

            ->addData('Kas Iuran Wajib', [$total_wajib1, $total_wajib2, $total_wajib3, $total_wajib4, $total_wajib5, $total_wajib6, $total_wajib7, $total_wajib8, $total_wajib9, $total_wajib10, $total_wajib11, $total_wajib12])
            ->addData('Kas Iuran Sukarela', [$total_sukarela1, $total_sukarela2, $total_sukarela3, $total_sukarela4, $total_sukarela5, $total_sukarela6, $total_sukarela7, $total_sukarela8, $total_sukarela9, $total_sukarela10, $total_sukarela11, $total_sukarela12])
            ->addData('Kas Iuran Kondisional', [$total_kondisional1, $total_kondisional2, $total_kondisional3, $total_kondisional4, $total_kondisional5, $total_kondisional6, $total_kondisional7, $total_kondisional8, $total_kondisional9, $total_kondisional10, $total_kondisional11, $total_kondisional12])
            ->addData('Kas Iuran Agenda', [$total_agenda1, $total_agenda2, $total_agenda3, $total_agenda4, $total_agenda5, $total_agenda6, $total_agenda7, $total_agenda8, $total_agenda9, $total_agenda10, $total_agenda11, $total_agenda12])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Asgustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
