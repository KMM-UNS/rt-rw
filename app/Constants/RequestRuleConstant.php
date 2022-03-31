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
            'rumah_telp' => 'required',
            'rumah_status_penggunaan_id' => 'required',
            'rumah_status_hunian_id' => 'required'
        ];
    }
}
