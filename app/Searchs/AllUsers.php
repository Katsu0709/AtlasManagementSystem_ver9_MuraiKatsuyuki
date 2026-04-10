<?php

namespace App\Searchs;

use App\Models\Users\User;

class AllUsers implements DisplayUsers
{

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
        $q->whereIn('subjects.id', $subjects);
      })
        ->where('role', 4);
    }

    if (is_array($updown)) {
      $updown = $updown[0] ?? 'ASC';
    }

    if (empty($updown) || !in_array(strtolower($updown), ['asc', 'desc'])) {
      $updown = 'ASC';
    }
    return $users->orderBy('id', $updown)->get();
  }
}
