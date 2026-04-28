<?php

namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay
{
  protected $carbon;

  function __construct($date)
  {
    $this->carbon = new Carbon($date);
  }

  function getClassName()
  {
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function pastClassName()
  {
    return;
  }

  /**
   * @return
   */

  function render()
  {
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  function selectPart($ymd)
  {
    // 1部〜3部のデータを取得
    $one_part_frame_data = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part_frame_data = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part_frame_data = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    $getRemaining = function ($frame) {
      if (!$frame) return 0;
      // 定員 (limit_users) - 現在の予約人数 (users->count())
      $remaining = $frame->limit_users - $frame->users->count();
      return $remaining >= 0 ? $remaining : 0;
    };

    $one_part_frame = $getRemaining($one_part_frame_data);
    $two_part_frame = $getRemaining($two_part_frame_data);
    $three_part_frame = $getRemaining($three_part_frame_data);

    $html = [];
    $html[] = '<select name="getPart[' . $ymd . ']" class="text-dark border-primary calendar-select-box" style="border-radius:5px;" form="reserveParts">';
    $html[] = '<option value="" selected class="default-option"></option>';

    // 1部
    if ($one_part_frame <= 0) {
      $html[] = '<option value="1" label="リモ1部" disabled>リモ1部(残り0枠)</option>';
    } else {
      $html[] = '<option value="1">リモ1部(残り' . $one_part_frame . '枠)</option>';
    }

    // 2部
    if ($two_part_frame <= 0) {
      $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
    } else {
      $html[] = '<option value="2">リモ2部(残り' . $two_part_frame . '枠)</option>';
    }

    // 3部
    if ($three_part_frame <= 0) {
      $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
    } else {
      $html[] = '<option value="3">リモ3部(残り' . $three_part_frame . '枠)</option>';
    }

    $html[] = '</select>';
    return implode('', $html);
  }

  function getDate()
  {
    return '<input type="hidden" value="' . $this->carbon->format('Y-m-d') . '" name="getData[]" form="reserveParts">';
  }

  function everyDay()
  {
    return $this->carbon->format('Y-m-d');
  }

  function authReserveDay()
  {
    return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
  }

  function authReserveDate($reserveDate)
  {
    return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
  }
}
