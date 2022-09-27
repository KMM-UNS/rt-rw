<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use App\Constants\RequestRuleConstant;
use Illuminate\Foundation\Http\FormRequest;

class IuranWajibForm extends FormRequest
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
        $rules = [
            'foto_iuranwajib' => [
                'mimes:pdf,jpeg,jpg,png|max:2048'
            ]
        ];
        $rules = [
            $rrc->KasIuranWajibTable(),
            $rules
        ];

        return Arr::collapse($rules);
    }
}
