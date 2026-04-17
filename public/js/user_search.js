$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

  $('.search_conditions_toggle').click(function () {
    // 中身をスライドで開閉
    $('.search_conditions_inner').slideToggle();

    // クラスを付け替えて矢印の向きを変える
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
      $('.arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
      $('.arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
  });

  $('#reset-button').click(function () {
    const form = $('#userSearchRequest'); // フォームのID

    // 1. テキスト入力やセレクトボックスを初期化
    form[0].reset();

    // 2. ラジオボタンやチェックボックスのチェックを外す
    form.find('input[type="radio"], input[type="checkbox"]').prop('checked', false);

    // 3. セレクトボックスを一番上の項目に戻す
    form.find('select').prop('selectedIndex', 0);
  });

});
