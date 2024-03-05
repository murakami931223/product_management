<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductregistRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required | max:255',
            'company_id' => 'required',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'comment' => 'max:10000',
            'img_path' => 'file | mimes:jpg,jpeg,png,gif',
        ];
    }

    /**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'product_name.required' => ':attributeは必須項目です。',
        'product_name.max' => ':attributeは:max字以内で入力してください。',
        'company_id.required' => ':attributeは必須項目です。',
        'price.required' => ':attributeは必須項目です。',
        'price.integer' => ':attributeは数字で入力してください。',
        'stock.required' => ':attributeは必須項目です。',
        'stock.integer' => ':attributeは数字で入力してください。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
        'img_path.file' => ':attributeはファイル形式で選択してください。',
        'img_path.mimes' => ':attributeはjpg,jpeg,png,gifで選択してください。',
        
    ];
}

public function attributes() {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
        ];
    }


}