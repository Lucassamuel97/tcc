<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description'=>'required',
            'hodometro'=>'required|numeric',
            'identification_number'=>'required'
        ];
    }

    public function messages(){
        return [
            'description.required' => 'Coloque uma descrição',
            'hodometro.numeric' => 'Coloque somente numeros no hodômetro',
            'hodometro.required' => 'Coloque o valor do hodometro',
            'identification_number.required' => 'Coloque o N° de Identificação'
        ];
    }
}



