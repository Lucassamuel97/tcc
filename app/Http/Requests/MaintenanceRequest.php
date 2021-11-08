<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description'=>'required',
            'range_hodometro'=>'required|numeric',
            'range_months'=>'required|numeric',
            'last_hodometro'=>'required|numeric',
            'last_months'=>'required|date'
        ];
    }

    public function messages(){
        return [
            'description.required' => 'Coloque uma descrição.',
            'range_hodometro.numeric' => 'Coloque somente numeros no periodo de horas.',
            'range_hodometro.required' => 'Coloque o valor de horas para realizar a manutenção.',
            'range_months.numeric' => 'Coloque somente numeros no periodo de meses.',
            'range_months.required' => 'Coloque um periodo de meses.',
            'last_hodometro.numeric' => 'Coloque somente numeros no Hodômetro da última manutenção.',
            'last_hodometro.required' => 'Preencha o valor do Hodômetro da última manutenção.',
            'last_months.required' => 'Preencha a data da última manutenção.',
            'last_months.date' => 'Coloque uma data valida no campo data da última manutenção.'
        ];
    }
}
