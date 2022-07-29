<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Constants\RequestRuleConstant;
use Illuminate\Foundation\Http\FormRequest;

class WargaForm extends FormRequest
{
   /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return back()->withInput()->withToastError($validator->messages()->all()[0]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(RequestRuleConstant $rrc)
    {
        // $rules = [
        //     'foto' => [
        //         Rule::requiredIf(function () {
        //             return request()->method() != "PUT";
        //         }),
        //         'mimes:png,jpeg,jpg|max:2048'
        //     ]
        // ];
        // $rules = [
        //     'warga_nik' => 'required|min:16|max:16|unique:warga,nik,'.$this->warga,
        //     'warga_nama' => 'required',
        //     'warga_jenis_kelamin' => 'required',
        //     'warga_agama_id' => 'required',
        //     'warga_golongan_darah_id' => 'required',
        //     'warga_tempat_lahir' => 'required',
        //     'warga_tanggal_lahir' => 'required',
        //     'warga_warga_negara_id' => 'required',
        //     'warga_pendidikan_id' => 'required',
        //     'warga_pekerjaan_id' => 'required',
        //     'warga_status_keluarga_id' => 'required',
        //     'warga_status_kawin_id' => 'required',
        //     'warga_alamat' => 'required',
        //     'warga_status_warga_id' => 'required',
        //     $rules
        // ];

        // // dd();
        // return Arr::collapse($rules);

        return [
            'warga_nik' => 'required|min:16|max:16|unique:warga,nik,'.$this->warga,
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
            'warga_status_warga_id' => 'required',
            'foto' => [
                        Rule::requiredIf(function () {
                            return request()->method() != "PUT";
                        }),
                        'mimes:png,jpeg,jpg|max:2048'
                    ]
                    ];
    }
}
