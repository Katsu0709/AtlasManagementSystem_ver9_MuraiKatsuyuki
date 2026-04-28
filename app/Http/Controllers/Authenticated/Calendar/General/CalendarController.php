<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show()
    {
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request)
    {
        DB::beginTransaction();
        try {
            $getPart = $request->getPart;

            $reserveDays = array_filter($getPart);

            foreach ($reserveDays as $key => $value) {
                // $key が日付（setting_reserve）、$value が部（setting_part）
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)
                    ->where('setting_part', $value)
                    ->first();

                if ($reserve_settings) {
                    $reserve_settings->decrement('limit_users');
                    $reserve_settings->users()->attach(Auth::id());
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function deleteParts(Request $request)
    {
        DB::beginTransaction();
        try {
            $reserve_id = $request->delete_id;
            Auth::user()->reserveSettings()->detach($reserve_id);
            $reserve_setting = ReserveSettings::findOrFail($reserve_id);
            $reserve_setting->increment('limit_users');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
