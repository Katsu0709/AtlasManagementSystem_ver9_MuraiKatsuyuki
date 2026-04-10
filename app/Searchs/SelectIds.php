<?php

namespace App\Searchs;

use App\Models\Users\User;

class SelectIds implements DisplayUsers
{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects)
  {
    if (is_null($gender)) {
      $gender = ['1', '2', '3'];
    } else {
      $gender = array($gender);
    }
    if (is_null($role)) {
      $role = ['1', '2', '3', '4'];
    } else {
      $role = array($role);
    }

    $users = User::with('subjects')
      ->where(function ($q) use ($keyword) {
        $q->where('over_name', 'like', '%' . $keyword . '%')
          ->orWhere('under_name', 'like', '%' . $keyword . '%')
          ->orWhere('over_name_kana', 'like', '%' . $keyword . '%')
          ->orWhere('under_name_kana', 'like', '%' . $keyword . '%');
      })
      ->whereIn('sex', $gender)
      ->whereIn('role', $role);

    if (!empty($subjects)) {
      $users->whereHas('subjects', function ($q) use ($subjects) {
        $q->whereIn('subjects.id', (array)$subjects);
      })
        ->where('role', 4);
    }

    return $users->orderBy('id', $updown)->get();
  }
}
