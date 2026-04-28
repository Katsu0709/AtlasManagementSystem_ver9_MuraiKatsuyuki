$(function () {
  // モーダルを開く
  $('.js-modal-open').on('click', function () {
    // ボタンからデータを取得
    const date = $(this).data('date');
    const part = $(this).data('part');
    const id = $(this).data('id');

    // モーダル内の表示を書き換え
    $('#modal-date').text(date);
    $('#modal-part').text(part);
    $('#modal-id').val(id); // formにIDをセット

    $('.js-modal').fadeIn();
    return false;
  });

  // モーダルを閉じる
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
