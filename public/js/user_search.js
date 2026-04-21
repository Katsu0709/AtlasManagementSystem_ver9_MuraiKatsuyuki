$(function () {
  $('.search_conditions_toggle, .subject_edit_btn').on('click', function () {

    $(this).next().slideToggle();

    $(this).toggleClass('open');

    const arrow = $(this).find('.arrow');
    if ($(this).hasClass('open')) {
      arrow.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
      arrow.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
  });

  $('#reset-button').click(function () {
    const form = $('#userSearchRequest');
    if (form.length) {
      form[0].reset();
      form.find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
      form.find('select').prop('selectedIndex', 0);
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
