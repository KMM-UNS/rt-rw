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
            'rumah_status_penggunaan_id' => 'required',
            'rumah_status_hunian_id' => 'required'
        ];
    }

    public static function wargaTable()
    {
        return [
            'warga_nik' => 'required|unique:warga,nik|max:16',
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
            'keluarga_no_kk' => 'required|unique:keluarga,no_kk|max:16',
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
}
