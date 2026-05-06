<x-sidebar>
  <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
    <div class="w-75 h-75">

      <div style="font-size:x-large;">
        <span>{{ date('Y年m月d日', strtotime($date)) }}</span>
        <span class="ml-3">{{ $part }}部</span>
      </div>

      <div class="reserve_detail card shadow p-2 mt-2" style="background-color: #FFF; border-radius:10px; font-size:larger;">
        <div>
          <table class="table table-striped table-hover m-0">
            <thead>
              <tr class="text-white text-center" style="background-color: #03AAD2;">
                <th class="border-0 py-1 pl-0">ID</th>
                <th class="border-0 py-1 pl-0">名前</th>
                <th class="border-0 py-1 px-5">場所</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservePersons as $setting)
              @foreach($setting->users as $user)
              <tr class="text-center">
                <td class="align-middle pl-0">{{ $user->id }}</td>
                <td class="align-middle pl-0">{{ $user->over_name }} {{ $user->under_name }}</td>
                <td class="align-middle px-5">リモート</td>
              </tr>
              @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</x-sidebar>
