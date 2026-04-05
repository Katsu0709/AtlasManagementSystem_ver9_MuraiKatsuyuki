<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $birth_day = sprintf('%04d-%02d-%02d', $this->old_year, $this->old_month, $this->old_day);
        $this->merge([
            'birth_day' => $birth_day,
        ]);
    }

    public function rules(): array
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' => 'required|email|unique:users,mail_address|max:100',
            'sex' => 'required|in:1,2,3',
            'birth_day' => 'required|date|after_or_equal:2000-01-01|before_or_equal:today',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|between:8,30|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'over_name.required' => '名前は必ず入力してください。',
            'over_name.max' => '姓は10文字以内で入力してください。',

            'under_name.required' => '名前必ず入力してください。',
            'under_name.max' => '名は10文字以内で入力してください。',

            'over_name_kana.required' => '名前は必ず入力してください。',
            'over_name_kana.regex' => 'セイはカタカナで入力してください。',
            'over_name_kana.max'      => 'セイは30文字以内で入力してください。',

            'under_name_kana.required' => '名前は必ず入力してください。',
            'under_name_kana.regex' => 'メイはカタカナで入力してください。',
            'under_name_kana.max'      => 'メイは30文字以内で入力してください。',

            'mail_address.required' => 'メールアドレスは必ず入力してください。',
            'mail_address.email' => 'メール形式で入力してください。',
            'mail_address.unique' => 'このメールアドレスは既に登録されています。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',

            'password.required' => 'パスワードを設定してください。',
            'password.between' => 'パスワードは8文字以上30文字以内で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',

            'sex.required' => '性別を選択してください。',
            'sex.in' => '正しい性別を選択してください。',

            'birth_day.date' => '正しい日付を選択してください。',
            'birth_day.required' => '生年月日が未入力です。',
            'birth_day.after_or_equal'  => '2000年1月1日以降の日付を入力してください。',
            'birth_day.before_or_equal' => '今日以前の日付を入力してください。',

            'role.required' => '役職を選択してください。',
            'role.in' => '正しい役職を選択してください。'

        ];
    }
}
