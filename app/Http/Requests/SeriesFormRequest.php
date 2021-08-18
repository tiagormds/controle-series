<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomeSerie' => 'required|min:3',
            'numeroTemporadas' => 'required',
            'numeroEpisodios' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomeSerie.required' => 'O campo ":attribute" é obrigatório.',
            'numeroTemporadas.required' => 'O campo ":attribute" é obrigatório.',
            'numeroEpisodios.required' => 'O campo ":attribute" é obrigatório.',
            'nomeSerie.min' => 'No campo ":attribute", digitar no mínimo, 3 caracteres.',
        ];
    }
}
