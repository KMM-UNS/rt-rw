<?php

namespace App\Constants;

use Illuminate\Validation\Rule;

class RequestRuleConstant
{
    public static function userTable()
    {
        return [
            'user_name' => 'required|min:3',
            'user_email' => 'required|min:7|max:30',
            'user_phone_number' => 'required|min:7|max:20',
            'user_password' => 'sometimes|required|min:6|confirmed',
        ];
    }

    public static function userProfileTable()
    {
        return [
            'user_profile_nik_ektp' => 'required',
            'user_profile_gender' => 'required|in:laki-laki,perempuan',
            'user_profile_tempat_lahir' => 'required',
            'user_profile_tanggal_lahir' => 'required',
            'user_profile_alamat' => 'required',
        ];
    }

    public static function settingTable()
    {
        return [
            'name' => 'required|unique:settings,name,' . request()->route('setting') . 'id',
            'value' => 'required'
        ];
    }

    public static function accountTable()
    {
        return [
            'account_name' => 'required|min:2',
            'account_number' => 'required|min:3|integer',
            'account_opening_balance' => 'sometimes|required',
            'account_bank_name' => 'nullable',
            'account_bank_address' => 'nullable',
            'account_bank_phone' => 'nullable',
            'account_enabled' => 'sometimes|required',
        ];
    }

    public static function paymentMethodTable()
    {
        return [
            'pm_name' => 'required|min:3',
        ];
    }

    public static function shippingTable()
    {
        return [
            'shipping_name' => 'required|min:3',
            'shipping_office_phone' => 'nullable',
            'shipping_office_address' => 'nullable',
        ];
    }

    public static function shipperTable()
    {
        return [
            'shipper_name' => 'required|min:3',
            'shipper_phone' => 'nullable',
            'shipper_address' => 'nullable',
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

    public static function masterTable()
    {
        return [
            'nama' => 'required'
        ];
    }

    public static function rumahTable()
    {
        return [
            'rumah_alamat' => 'required',
            'rumah_nomor_rumah' => 'required',
            'rumah_status_penggunaan_rumah_id' => 'required',
            'rumah_status_hunian_id' => 'required'
        ];
    }

    public static function wargaTable()
    {
        return [
            'warga_nik' => 'required|min:16|max:16',
            'warga_nama' => 'required',
            'warga_jenis_kelamin' => 'required',
            'warga_agama_id' => 'required',
            'warga_golongan_darah_id' => 'required',
            'warga_tempat_lahir' => 'required',
            'warga_tanggal_lahir' => 'required',
            'warga_warga_negara_id' => 'required',
            'warga_pendidikan_id' => 'required',
            'warga_pekerjaan_id' => 'required',
            'warga_status_keluarga_id' => 'required',
            'warga_status_kawin_id' => 'required',
            'warga_alamat' => 'required',
            'warga_status_warga_id' => 'required'
        ];
    }

    public static function keluargaTable()
    {
        return [
            'keluarga_no_kk' => 'required|min:16|max:16',
            'keluarga_kepala_keluarga' => 'required',
            'keluarga_rumah_id' => 'required',
            'keluarga_telp' => 'required'
        ];
    }

    public static function suratTable()
    {
        return [
            'surat_keperluan_surat_id' => 'required',
            'surat_warga_id' => 'required'
        ];
    }

    public static function tamuTable()
    {
        return [
            'tamu_jumlah' => 'required|integer',
            'tamu_nama' => 'required',
            'tamu_alamat' => 'required',
            'tamu_hubungan' => 'required',
            'tamu_tanggal_tiba' => 'required',
            'tamu_lama_menetap' => 'required|integer',
            'tamu_keluarga_id' => 'required',
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
