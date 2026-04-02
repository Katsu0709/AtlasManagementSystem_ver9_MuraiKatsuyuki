<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryFormRequest extends FormRequest
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
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
        ];
    }

    public function messages()
    {
        return [
            'main_category_name.required' => 'メインカテゴリー名は必ず入力してください。',
            'main_category_name.string'   => '正しい形式で入力してください。',
            'main_category_name.max'      => 'メインカテゴリー名は100文字以内で入力してください。',
            'main_category_name.unique'   => 'そのカテゴリーは既に登録されています。',
        ];
    }
}
