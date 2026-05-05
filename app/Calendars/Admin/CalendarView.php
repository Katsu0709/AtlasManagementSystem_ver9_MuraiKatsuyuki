<?php

namespace App\Calendars\Admin;


use Carbon\Carbon;
use App\Models\Users\User;
use App\Models\Calendars\ReserveSettings;

class CalendarView
{
  private $carbon;

  function __construct($date)
  {
    $this->carbon = new Carbon($date);
  }

  public function getTitle()
  {
    return $this->carbon->format('Y年n月');
  }

  public function render()
  {
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table table-bordered">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th class="text-primary">土</th>';
    $html[] = '<th class="text-danger">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();

    foreach ($weeks as $week) {
      $html[] = '<tr class="' . $week->getClassName() . '">';
      $days = $week->getDays();
      foreach ($days as $day) {
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = \Carbon\Carbon::today()->format("Y-m-d");

        // 土日の判定用クラス
        $dayClass = '';
        if ($day->everyDay()) {
          $date = \Carbon\Carbon::parse($day->everyDay());
          if ($date->isSaturday()) {
            $dayClass = 'text-primary'; // 土曜日は青
          } elseif ($date->isSunday()) {
            $dayClass = 'text-danger';  // 日曜日は赤
          }
        }

        // 空白マスの処理
        if (strpos($day->getClassName(), 'day-blank') !== false) {
          $html[] = '<td class="calendar-td ' . $day->getClassName() . '">';
          $html[] = $day->render();
          $html[] = '</td>';
          continue;
        }

        // 過去・未来の背景とクラス判定
        if ($startDay <= $day->everyDay() && $toDay > $day->everyDay()) {
          $html[] = '<td class="calendar-td bg-secondary-subtle ' . $dayClass . '">';
        } else {
          $html[] = '<td class="calendar-td ' . $day->getClassName() . ' ' . $dayClass . '">';
        }

        $html[] = '<div class="calendar-content">';
        $html[] = $day->render();

        for ($part = 1; $part <= 3; $part++) {
          $setting = \App\Models\Calendars\ReserveSettings::withCount('users')
            ->where('setting_reserve', $day->everyDay())
            ->where('setting_part', $part)
            ->first();

          $count = $setting ? $setting->users_count : 0;

          $html[] = '<div class="part-row" style="font-size:14px; width:100%;">';

          $detailUrl = route('calendar.admin.detail', ['date' => $day->everyDay(), 'part' => $part]);

          $html[] = '  <a href="' . $detailUrl . '" class="part-link d-flex justify-content-center ">';
          $html[] = '    <span class="pb-1" style="margin-right: 50px; color:#03AAD2;">' . $part . '部</span>';
          $html[] = '    <span class="text-dark">' . $count . '</span>';
          $html[] = '  </a>';
          $html[] = '</div>';
        }

        $html[] = '</div>'; // .calendar-content end
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    return implode("", $html);
  }

  protected function getWeeks()
  {
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while ($tmpDay->lte($lastDay)) {
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
