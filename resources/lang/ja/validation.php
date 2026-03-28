<?php

return [
    'required' => ':attributeは必須項目です。',
    'email'    => '正しいメールアドレスを入力してください。',
    'regex'    => ':attributeは正しい形式で入力してください。',
    'date'     => '正しい日付を選択してください。',
    'between'  => [
        'numeric' => ':attributeは:min〜:maxの間で入力してください。',
        'string'  => ':attributeは:min〜:max文字で入力してください。',
    ],
    'confirmed' => 'パスワードが一致しません。',
    'unique'    => 'その:attributeは既に使用されています。',

    'attributes' => [
        'over_name' => '姓',
        'under_name' => '名',
        'over_name_kana' => 'セイ',
        'under_name_kana' => 'メイ',
        'mail_address' => 'メールアドレス',
        'sex' => '性別',
        'birth_day' => '生年月日',
        'role' => '役職',
        'password' => 'パスワード',
    ],
];
