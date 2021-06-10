<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Response\BaseResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupervisorProdukRequest extends FormRequest
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
            'status_verifikasi' => 'required|numeric',
            'alasan_penolakan' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(
            (BaseResponse::unprocessableEntity(
                ['error' => $validator->errors()->toArray()]
            )->original), 422));
    }
}
