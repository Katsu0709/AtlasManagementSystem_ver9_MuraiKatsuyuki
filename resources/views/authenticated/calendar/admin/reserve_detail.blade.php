<x-sidebar>
  <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
    <div class="w-50 m-auto h-75">
      <!-- 該当日時を表示 -->
      <span>{{ $date }}日</span>
      <span class="ml-3">{{ $part }}部</span>
      </p>

      <div class="card shadow p-2" style="background-color: #FFF; border-radius:10px">
        <div>
          <table class="table table-striped table-hover m-0">
            <thead>
              <tr class="text-white text-center" style="background-color: #03AAD2;">
                <th class="w-25 border-0">ID</th>
                <th class="w-50 border-0">名前</th>
                <th class="w-25 border-0">場所</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservePersons as $setting)
              @foreach($setting->users as $user)
              <tr class="text-center">
                <td class="align-middle">{{ $user->id }}</td>
                <td class="align-middle">{{ $user->over_name }} {{ $user->under_name }}</td>
                <td class="align-middle">リモート</td>
              </tr>
              @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</x-sidebar>
