<?php

namespace App\Charts\Admin;

use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SuratChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }



    public function build()
    {
        // $surat = Surat::get();
        $ktp = array();
        $skkb = array();
        $nikah = array();
        $sktm = array();
        $skck = array();
        $skd = array();
        $lainnya = array();
        for($i = 1; $i <= 7 ; $i++){
            for($j = 1; $j <= 12; $j++){
                $x = DB::table('surat')->where('keperluan_surat_id', $i)->whereMonth('tanggal_pengajuan', $j)->whereYear('tanggal_pengajuan', 2022)->count();
                switch ($i) {
                    case 1:
                      array_push($ktp, $x);
                      break;
                    case 2:
                      array_push($skkb, $x);
                      break;
                    case 3:
                      array_push($nikah, $x);
                      break;
                    case 4:
                      array_push($sktm, $x);
                      break;
                    case 5:
                      array_push($skck, $x);
                      break;
                    case 6:
                      array_push($skd, $x);
                      break;
                    case 7:
                      array_push($lainnya, $x);
                      break;
                  }
                }
                // dd($ktp);
        }
        // $result = array_values($data);
        return $this->chart->barChart()
            ->setFontFamily('Open Sans')
            ->addData('Perpanjangan KTP / KK / KIPEM',$ktp)
            ->addData('Surat Keterangan Kelakuan Baik',$skkb)
            ->addData('Surat Pengantar Nikah',$nikah)
            ->addData('Surat Keterangan Tidak Mampu',$sktm)
            ->addData(' Persyaratan Pembuatan SKCK',$skck)
            ->addData('Surat Keterangan Domisili',$skd)
            ->addData('Lainnya...', $lainnya)
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
        }
}
