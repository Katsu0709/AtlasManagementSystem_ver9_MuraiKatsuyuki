<x-sidebar>
  <div class="vh-100 pt-4" style="background:#ECF1F6;">
    <div class="w-75 m-auto pt-5 pb-4 shadow" style="border-radius:5px; background:#FFF;">
      <div class="calendar_table">
        <p class="text-center" style="font-size:1.5rem;">{{ $calendar->getTitle() }}</p>
        <div class="">
          {!! $calendar->render() !!}
        </div>
      </div>
      <div class="reserve-button text-right">
        <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </div>
    </div>
  </div>

  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <p>予約日：<span id="modal-date"></span></p>
      <p>時間：<span id="modal-part"></span></p>
      <p>上記の予約をキャンセルしてもよろしいですか？</p>

      <div class="modal__btns">
        <button type="button" class="btn btn-primary js-modal-close">閉じる</button>
        <form action="{{ route('deleteParts') }}" method="post">
          @csrf
          <input type="hidden" name="delete_id" id="modal-id" value="">
          <input type="submit" class="btn btn-danger" value="キャンセル">
        </form>
      </div>
    </div>
  </div>
</x-sidebar>
