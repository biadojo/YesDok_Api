<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Response\BaseResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdukRequest extends FormRequest
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
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga_satuan' => 'required|numeric',
            'stok_produk' => 'required|numeric',
            'foto_produk' => 'mimes:jpg,jpeg,png',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'mimes' => ':attribute harus berekstensi jpg, jpeg, atau png',
            'numeric' => ':attribute harus berupa angka',
            'date_format' => 'Format :attribute tidak sesuai. (Format: Y-m-d)',
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
