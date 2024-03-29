<?php

namespace App\Http\Requests\Admin;

use App\Constants\RequestRuleConstant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KeluargaForm extends FormRequest
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
        $validator->sometimes('password', 'required|min:6|confirmed', function ($request) {
            return $request->password;
        });

        if ($validator->fails()) {
            return back()->withInput()->withToastError($validator->messages()->all()[0]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keluarga_no_kk' => 'required|min:16|max:16|unique:keluarga,no_kk,'.$this->keluarga,
            'keluarga_kepala_keluarga' => 'required',
            'keluarga_rumah_id' => 'required',
            'keluarga_telp' => 'required',
            'kartu_keluarga' => [
                Rule::requiredIf(function () {
                    return request()->method() != "PUT";
                }),
                'mimes:pdf,png,jpeg,jpg|max:2048'
            ],
            'ktp' => [
                Rule::requiredIf(function () {
                    return request()->method() != "PUT";
                }),
                'mimes:pdf,png,jpeg,jpg|max:2048'
            ],
            'surat_nikah' => [
                'mimes:pdf,png,jpeg,jpg|max:2048'
            ]
        ];
    }
}
