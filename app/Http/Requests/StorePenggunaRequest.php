<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Response\BaseResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePenggunaRequest extends FormRequest
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
            'email' => 'required|unique:pembeli,email',
            'name' => 'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'min' => ':attribute harus memiliki panjang minimal 6 karakter'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(
            (BaseResponse::unprocessableEntity(
                ['error' => $validator->errors()->toArray()]
            )->original), 422));
    }
}
