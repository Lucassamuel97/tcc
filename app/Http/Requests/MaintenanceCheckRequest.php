<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceCheckRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'maintenance_id'=>'required',
            'price'=>'numeric'
        ];
    }

    public function messages(){
        return [
            'maintenance_id.required' => 'Erro: maquinario não selecionado.',
            'price.numeric' => 'Coloque somente numeros no preco.'
        ];
    }
}
