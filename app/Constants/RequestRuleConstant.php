<?php

namespace App\Constants;

class RequestRuleConstant
{
    public static function settingTable()
    {
        return [
            'name' => 'required|unique:settings,name,' . request()->route('setting') . 'id',
            'value' => 'required'
        ];
    }

    public static function adminTable()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,' . request()->route('admin') . 'id',
            'pangkat' => 'nullable|string',
            'nrp' => 'nullable|integer',
            'password' => 'nullable',
            'department_id' => 'required'
        ];
    }

    public static function KasIuranWajibTable()
    {
        return [
            'kas_iuran_wajibs_jenis_iuran_id' => 'required',
            'kas_iuran_wajibs_tanggal' => 'required',
            // 'kas_iuran_wajibs_pos' => 'required',
            // 'kas_iuran_wajibs_petugas' => 'required',
            'kas_iuran_wajibs_warga' => 'required',
            'kas_iuran_wajibs_total_biaya' => 'required',
            'kas_iuran_wajibs_status' => 'required'
        ];
    }
    public static function KasIuranSukarelaTable()
    {
        return [
            'kas_iuran_suka_relas_jenis_iuran_id' => 'required',
            'kas_iuran_suka_relas_tanggal' => 'required',
            // 'kas_iuran_suka_relas_pos' => 'required',
            // 'kas_iuran_suka_relas_petugas' => 'required',
            'kas_iuran_suka_relas_warga' => 'required',
            'kas_iuran_suka_relas_total_biaya' => 'required',
            'kas_iuran_suka_relas_status' => 'required'
        ];
    }

    public static function KasIuranKondisionalTable()
    {
        return [
            'kas_iuran_kondisionals_jenis_iuran_id' => 'required',
            'kas_iuran_kondisionals_tanggal' => 'required',
            // 'kas_iuran_kondisionals_pos' => 'required',
            // 'kas_iuran_kondisionals_petugas' => 'required',
            'kas_iuran_kondisionals_warga' => 'required',
            'kas_iuran_kondisionals_total_biaya' => 'required',
            'kas_iuran_kondisionals_status' => 'required'
        ];
    }

    public static function KasIuranAgendaTable()
    {
        return [
            'kas_iuran_agendas_jenis_iuran_id' => 'required',
            'kas_iuran_agendas_tanggal' => 'required',
            // 'kas_iuran_agendas_pos' => 'required',
            // 'kas_iuran_agendas_petugas' => 'required',
            'kas_iuran_agendas_warga' => 'required',
            'kas_iuran_agendas_total_biaya' => 'required',
            'kas_iuran_agendas_status' => 'required'
        ];
    }
    public static function PetugasTagihanTable()
    {
        return [
            'petugas_tagihans_nama' => 'required',
            'petugas_tagihans_ttgl' => 'required',
            'petugas_tagihans_no_telp' => 'required',
            'petugas_tagihans_alamat' => 'required',
            'petugas_tagihans_pos' => 'required'
        ];
    }
    public static function KeluargaTable()
    {
        return [
            'keluargas_nama' => 'required',
            // 'keluargas_ttgl' => 'required',
            'keluargas_telp' => 'required',
            // 'keluargas_alamat' => 'required',
            // 'keluargas_pos' => 'required'
        ];
    }
    public static function PengeluaranTable()
    {
        return [
            'manajemen_pengeluarans_keterangan' => 'required',
            'manajemen_pengeluarans_tanggal' => 'required',
            'manajemen_pengeluarans_nominal' => 'required',
            // 'pengeluarans_alamat' => 'required',
            // 'pengeluarans_pos' => 'required'
        ];
    }
}
