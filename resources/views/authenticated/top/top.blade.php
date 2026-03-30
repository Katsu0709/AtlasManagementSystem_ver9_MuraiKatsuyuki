<x-sidebar>
  <div class="vh-100 border">
    <div class="top_area pt-3 px-4">
      <p class="text-lg">自分のプロフィール</p>
      <div class="user_status shadow rounded-[30px] p-3 bg-white w-75 m-auto" style="margin-top:120px !important;">
        <p>名前：<span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span></p>
        <p>カナ：<span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span></p>
        <p>性別：@if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
        <p>生年月日：<span>{{ Auth::user()->birth_day }}</span></p>
      </div>
    </div>
  </div>
</x-sidebar>
