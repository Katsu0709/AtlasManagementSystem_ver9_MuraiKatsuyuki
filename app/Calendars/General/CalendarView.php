<?php

namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

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

  function render()
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

        $dayClass = '';
        if ($day->everyDay()) {
          $date = \Carbon\Carbon::parse($day->everyDay());
          if ($date->isSaturday()) {
            $dayClass = 'text-primary pt-0'; // 土曜日は青
          } elseif ($date->isSunday()) {
            $dayClass = 'text-danger pt-0';  // 日曜日は赤
          }
        }

        if (strpos($day->getClassName(), 'day-blank') !== false) {
          $html[] = '<td class="calendar-td ' . $day->getClassName() . '">';
          $html[] = $day->render();
          $html[] = '</td>';
          continue;
        }

        if ($startDay <= $day->everyDay() && $toDay > $day->everyDay()) {
          $html[] = '<td class="calendar-td bg-secondary-subtle pt-0 ' . $dayClass . '">';
        } else {
          $html[] = '<td class="calendar-td pt-0 ' . $day->getClassName() . ' ' . $dayClass . '">';
        }

        $html[] = '<div class="calendar-content">';
        $html[] = $day->render();

        if (in_array($day->everyDay(), $day->authReserveDay())) {
          $reserveData = $day->authReserveDate($day->everyDay())->first();
          $reservePart = $reserveData->setting_part;

          $partName = "";
          if ($reservePart == 1) $partName = "リモ1部";
          else if ($reservePart == 2) $partName = "リモ2部";
          else if ($reservePart == 3) $partName = "リモ3部";

          if ($toDay > $day->everyDay()) {
            $html[] = '<p class="p-0 text-dark m-0">' . $partName . '参加</p>';
          } else {
            $html[] = '<button type="button"
                    class="btn btn-danger p-0 js-modal-open reserve-item"
                    data-date="' . $day->everyDay() . '"
                    data-part="' . $partName . '"
                    data-id="' . $reserveData->id . '">' . $partName . '</button>';
          }
        } else {
          if ($toDay > $day->everyDay()) {
            $html[] = '<p class="text-dark m-0" style="font-size:16px">受付終了</p>';
          } else {
            $html[] = '<div class="calendar-item">' . $day->selectPart($day->everyDay());
          }
        }

        $html[] = $day->getDate();
        $html[] = '</div>';
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">' . csrf_field() . '</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">' . csrf_field() . '</form>';

    return implode('', $html);
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
