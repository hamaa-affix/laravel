<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:255'],
            'item-image'  => ['required', 'file', 'image'],
            'description' => ['required', 'string', 'max:2000'],
            'category'    => ['required', 'integer'],
            'condition'   => ['required', 'integer'],
            'price'       => ['required', 'integer', 'min:100', 'max:9999999'],
        ];
    }

    //バリデーションルールkyeを日本語化できる
    public function attributes()
    {
        return [
            'name' => '商品名',
            'item-image' => '商品画像',
            'description' => '商品説明',
            'category' => 'カテゴリー',
            'condition' => '商品状態',
            'price' => '販売価格'
        ];
    }
}
