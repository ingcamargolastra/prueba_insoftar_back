<?php

namespace PruebaInsoftar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

class UpdateUsuarioRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(
          response()->json([
            'success' => false,
            'errores' => $validator->errors()->all()
          ], 200)
        ); 
    }

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
            'id' => 'required|exists:usuarios',
            'cedula' => 'required|numeric|digits_between:1,20|unique:usuarios,cedula,'.$this->id,
            'nombres' => 'required|max:45',
            'apellidos' => 'required|max:45',
            'correo' => 'required|email|max:45|unique:usuarios,correo,'.$this->id,
            'telefono' => 'required|numeric|digits_between:1,20',
        ];
    }

    public function messages(){
        return[
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'telefono.required' => 'El campo telefono es obligatorio.',
            'correo.required' => 'El campo correo es obligatorio.',
            'nombres.max' => 'El campo nombres debe ser máximo 45 caracteres.',
            'apellidos.max' => 'El campo apellidos debe ser máximo 45 caracteres.',
            'cedula.max' => 'El campo cédula debe ser máximo 20 caracteres.',
            'telefono.max' => 'El campo teléfono debe ser máximo 20 caracteres.',
            'correo.max' => 'El campo correo debe ser máximo 45 caracteres.',
            'correo.unique' => 'El correo electrónico ingresado ya está en uso.',
            'cedula.unique' => 'La cédula ingresada ya está en uso.',
            'cedula.numeric' => 'La cédula debe ser un valor numerico',
            'telefono.numeric' => 'El teléfono debe ser un valor numerico',
        ];
    }

}
