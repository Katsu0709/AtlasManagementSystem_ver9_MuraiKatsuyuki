<x-guest-layout>
  <form action="{{ route('registerPost') }}" method="POST">
    @csrf
    <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
      <div class="bg-white shadow-xl w-[500px] p-5 border rounded-[30px]">

        <div class="register_form">

          <div class="d-flex mt-3" style="justify-content:space-between;">
            <div class="" style="width:180px">
              @error('over_name')
              <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
              @enderror
              <label class="d-block m-0" style="font-size:13px">姓</label>
              <div class="border-bottom border-primary" style="width:180px;">
                <input type="text" style="width:180px;" class="border-0 over_name" name="over_name">
              </div>
            </div>

            <div class="" style="width:180px">
              @error('under_name')
              <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
              @enderror
              <label class=" d-block m-0" style="font-size:13px">名</label>
              <div class="border-bottom border-primary" style="width:180px;">
                <input type="text" style="width:180px;" class="border-0 under_name" name="under_name">
              </div>
            </div>
          </div>


          <div class="d-flex mt-3" style="justify-content:space-between;">
            <div class="" style="width:180px">
              @error('over_name_kana')
              <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
              @enderror
              <label class="d-block m-0" style="font-size:13px">セイ</label>
              <div class="border-bottom border-primary" style="width:180px;">
                <input type="text" style="width:180px;" class="border-0 over_name_kana" name="over_name_kana">
              </div>
            </div>


            <div class="" style="width: 180px">
              @error('under_name_kana')
              <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
              @enderror
              <label class="d-block m-0" style="font-size:13px">メイ</label>
              <div class="border-bottom border-primary" style="width:180px;">
                <input type="text" style="width:180px;" class="border-0 under_name_kana" name="under_name_kana">
              </div>
            </div>
          </div>


          <div class="mt-3">
            @error('mail_address')
            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
            @enderror
            <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
            <div class="border-bottom border-primary">
              <input type="mail" class="w-100 border-0 mail_address" name="mail_address">
            </div>
          </div>

        </div>


        @error('sex')
        <span class="text-danger" style="font-size: 12px ;">{{ $message }}</span>
        @enderror
        <div class="flex justify-around items-center mt-3">
          <div class="items-center">
            <input type="radio" name="sex" class="sex" value="1">
            <label style="font-size:13px">男性</label>
          </div>
          <div class="items-center">
            <input type="radio" name="sex" class="sex" value="2">
            <label style="font-size:13px">女性</label>
          </div>
          <div class="items-center">
            <input type="radio" name="sex" class="sex" value="3">
            <label style="font-size:13px">その他</label>
          </div>
        </div>

        <div class="mt-3">
          @error('birth_day')
          <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
          @enderror
          <label class="d-block m-0 aa" style="font-size:13px">生年月日</label>

          <div class="flex justify-around items-center">
            <select name="old_year" class="appearance-none bg-transparent border-none border-bottom border-primary py-1 px-1 text-[13px] text-left focus:ring-0 outline-none w-[100px]">
              <option value="none">-----</option>
              @foreach (range(2000, date('Y')) as $year)
              <option value="{{ $year }}">{{ $year }}</option>
              @endforeach
            </select>
            <span class="text-[13px] ml-1 mr-2">年</span>

            <select name="old_month" class="appearance-none bg-transparent border-none border-bottom border-primary py-1 px-1 text-[13px] text-left focus:ring-0 outline-none w-[100px]">
              <option value="none">-----</option>
              @for ($i = 1; $i <= 12; $i++)
                <option value="{{ sprintf('%02d', $i) }}">{{ $i }}</option>
                @endfor
            </select>
            <span class="text-[13px] ml-1 mr-2">月</span>

            <select name="old_day" class="appearance-none bg-transparent border-none border-bottom border-primary py-1 px-1 text-[13px] text-left focus:ring-0 outline-none w-[100px]">
              <option value="none">-----</option>
              @for ($i = 1; $i <= 31; $i++)
                <option value="{{ sprintf('%02d', $i) }}">{{ $i }}</option>
                @endfor
            </select>
            <span class="text-[13px] ml-1">日</span>
          </div>
        </div>

        <div class="mt-3">
          @error('role')
          <span class="text-danger" style="font-size: 12px ;">{{ $message }}</span>
          @enderror
          <label class="d-block m-0" style="font-size:13px">役職</label>
          <div class="flex justify-between">
            <div class="items-center">
              <input type="radio" name="role" class="admin_role role" value="1">
              <label style="font-size:13px">教師(国語)</label>
            </div>
            <div class="items-center">
              <input type="radio" name="role" class="admin_role role" value="2">
              <label style="font-size:13px">教師(数学)</label>
            </div>
            <div class="items-center">
              <input type="radio" name="role" class="admin_role role" value="3">
              <label style="font-size:13px">教師(英語)</label>
            </div>
            <div class="items-center">
              <input type="radio" name="role" class="other_role role" value="4">
              <label style="font-size:13px" class="other_role">生徒</label>
            </div>
          </div>
        </div>

        <div class="select_teacher d-none">
          @error('subjects')
          <span class="text-danger" style="font-size: 12px ;">{{ $message }}</span>
          @enderror
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          <div class="flex justify-around">
            @foreach($subjects as $subject)
            <div class="items-center">
              <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
              <label>{{ $subject->subject }}</label>
            </div>
            @endforeach
          </div>
        </div>

        <div class="mt-3">
          @error('password')
          <span class="text-danger" style="font-size: 12px ;">{{ $message }}</span>
          @enderror
          <label class="d-block m-0" style="font-size:13px">パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password" name="password">
          </div>
        </div>
        <div class="mt-3">
          @error('password')
          <span class="text-danger" style="font-size: 12px ;">{{ $message }}</span>
          @enderror
          <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
          <div class="border-bottom border-primary">
            <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
          </div>
        </div>

        <div class="mt-5 text-right relative z-10">
          <input type="submit" class="btn btn-primary register_btn" value="新規登録" onclick="return confirm('登録してよろしいですか？')">
        </div>
        <div class="text-center">
          <a href="{{ route('loginView') }}">ログインはこちら</a>
        </div>

      </div>
    </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
