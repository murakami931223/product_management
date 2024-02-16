<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemregistRequest extends FormRequest
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
            'items_name' => 'required | max:255',
            'maker_name' => 'required',
            'price' => 'required | integer',
            'items_stock' => 'required | integer',
            'comment' => 'max:10000',
            'items_img' => 'file | mimes:jpg,jpeg,png,gif',
        ];
    }

    /**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'items_name.required' => ':attributeは必須項目です。',
        'items_name.max' => ':attributeは:max字以内で入力してください。',
        'maker_name.required' => ':attributeは必須項目です。',
        'price.required' => ':attributeは必須項目です。',
        'price.integer' => ':attributeは数字で入力してください。',
        'items_stock.required' => ':attributeは必須項目です。',
        'items_stock.integer' => ':attributeは数字で入力してください。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
        'items_img.file' => ':attributeはファイル形式で選択してください。',
        'items_img.mimes' => ':attributeはjpg,jpeg,png,gifで選択してください。',
        
    ];
}


}