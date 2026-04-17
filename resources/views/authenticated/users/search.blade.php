<x-sidebar>
  <div class="search_content w-100 d-flex">
    <div class="reserve_users_area flex-grow-1">
      @foreach($users as $user)
      <div class="border one_person shadow">
        <div>
          <span style="color: #999;">ID : </span><span>{{ $user->id }}</span>
        </div>
        <div class="mt-auto">
          <span style="color: #999;">名前 : </span>
          <a href="{{ route('user.profile', ['id' => $user->id]) }}" style="color: #03AAD2;">
            <span>{{ $user->over_name }}</span>
            <span>{{ $user->under_name }}</span>
          </a>
        </div>
        <div>
          <span style="color: #999;">カナ : </span>
          <span>({{ $user->over_name_kana }}</span>
          <span>{{ $user->under_name_kana }})</span>
        </div>
        <div class="my-auto">
          @if($user->sex == 1)
          <span style="color: #999;">性別 : </span><span>男</span>
          @elseif($user->sex == 2)
          <span style="color: #999;">性別 : </span><span>女</span>
          @else
          <span style="color: #999;">性別 : </span><span>その他</span>
          @endif
        </div>
        <div class="my-auto">
          <span style="color: #999;">生年月日 : </span><span>{{ $user->birth_day }}</span>
        </div>
        <div class="mt-auto">
          @if($user->role == 1)
          <span style="color: #999;">役職 : </span><span>教師(国語)</span>
          @elseif($user->role == 2)
          <span style="color: #999;">役職 : </span><span>教師(数学)</span>
          @elseif($user->role == 3)
          <span style="color: #999;">役職 : </span><span>講師(英語)</span>
          @else
          <span style="color: #999;">役職 : </span><span>生徒</span>
          @endif
        </div>
        <div>
          @if($user->role == 4)
          <span style="color: #999;">選択科目 :</span>
          @foreach($user->subjects as $subject)
          <span>{{ $subject->subject }}</span>
          @endforeach
          @endif
        </div>
      </div>
      @endforeach
    </div>
    <div class="search_area p-5" style="color: #666;">
      <div class="search_keyword">
        <p class="mt-2">検索</p>
        <input type="text" class="form-control" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>

      <div class="search_category mt-3">
        <label class="d-block">カテゴリ</label>
        <select class="form-control" form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div class="search_updown my-3">
        <label>並び替え</label>
        <select class="form-control" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>

      <div class="search_conditions_area">
        <details class="category-group">
          <summary class="main-category border-bottom mb-3" style="cursor: pointer; list-style: none; color:#666">
            <span class="d-flex justify-content-between align-items-center mt-3">検索条件の追加</span>
          </summary>

          <div class="search_conditions_inner">
            <div class="sex_selection mb-3">
              <label class="d-block">性別</label>
              <span style="color: black;">男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
              <span style="color: black;">女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
              <span style="color: black;">その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
            </div>

            <div class="role_selection mb-3">
              <label class="d-block">権限</label>
              <select name="role" form="userSearchRequest" class="form-control">
                <option selected disabled>----</option>
                <option value="1">教師(国語)</option>
                <option value="2">教師(数学)</option>
                <option value="3">教師(英語)</option>
                <option value="4">生徒</option>
              </select>
            </div>

            <div class="subject_selection">
              <label class="d-block">選択科目</label>
              <div class=" d-flex flex-wrap">
                @foreach($subject_lists as $subject)
                <div class="mr-3">
                  <label for="subject_{{ $subject->id }}">{{ $subject->subject }}</label>
                  <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject_{{ $subject->id }}" form="userSearchRequest">
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </details>
      </div>

      <div class="search_btn_area my-3">
        <button type="submit" form="userSearchRequest" class="btn search_btn text-white">検索</button>
      </div>
      <div class="reset_btn_wrap">
        <button type="button" id="reset-button" class="reset_link mt-2">リセット</button>
      </div>
    </div>
  </div>
  <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
  </div>
</x-sidebar>
