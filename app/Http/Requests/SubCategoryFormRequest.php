<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryFormRequest extends FormRequest
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

    public function rules()
    {
        return [
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ];
    }

    public function messages()
    {
        return [
            'main_category_id.required' => 'メインカテゴリーを選択してください。',
            'sub_category_name.required' => 'サブカテゴリー名は必須です。',
            'sub_category_name.unique' => 'そのサブカテゴリーは既に登録されています。',
            'sub_category_name.max' => '100文字以内で入力してください。',
        ];
    }
}
