<x-sidebar>
  <div class="vh-100 border">
    <div class="top_area pt-3 px-4">
      <span style="font-size:larger;">{{ $user->over_name }}</span><span style="font-size:larger;">{{ $user->under_name }}さんのプロフィール</span>

      <div class="user_status shadow rounded-[30px] p-3 bg-white w-75 m-auto" style="margin-top:75px !important;">
        <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
        <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
        <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
        <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
        <div>選択科目 :
          @foreach($user->subjects as $subject)
          <span>{{ $subject->subject }}</span>
          @endforeach
        </div>

        <div class="mt-3">
          <span class="subject_edit_btn subject_conditions_toggle">
            選択科目の登録 <i class="fas fa-chevron-down arrow"></i>
          </span>

          <div class="subject_inner" style="display: none;">
            <form action="{{ route('user.edit') }}" method="post">
              <div class="subject_flex_container mt-2">
                @foreach($subject_lists as $subject_list)
                <label class="subject_label">
                  {{ $subject_list->subject }}
                  <input class="ml-1" type="checkbox" name="subjects[]" value="{{ $subject_list->id }}"
                    @if($user->subjects->contains($subject_list->id)) checked @endif>
                </label>
                @endforeach
                <input type="submit" value="登録" class="btn btn-primary mb-2">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @csrf
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

</x-sidebar>
