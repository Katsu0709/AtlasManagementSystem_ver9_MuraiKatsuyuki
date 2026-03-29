$(function () {
  $(document).on('click', '.other_role', function () {
    $('.select_teacher').removeClass('d-none');
  });
  $(document).on('click', '.admin_role', function () {
    $('.select_teacher').addClass('d-none');
  });

  $(document).on('click keyup change', function () {

    var over_name = $('.over_name').val().length;
    $('.over_name').toggleClass('success_name', over_name >= 1);

    var over_name_kana = $('.over_name_kana').val().length;
    $('.over_name_kana').toggleClass('success_name_kana', over_name_kana >= 1);

    var under_name = $('.under_name').val().length;
    $('.under_name').toggleClass('success_under_name', under_name >= 1);

    var under_name_kana = $('.under_name_kana').val().length;
    $('.under_name_kana').toggleClass('success_under_name_kana', under_name_kana >= 1);

    var mail_address = $('.mail_address').val().length;
    $('.mail_address').toggleClass('success_mail_address', mail_address >= 1);

    var password = $('.password').val().length;
    $('.password').toggleClass('success_password', password >= 1);

    var password_confirm = $('.password_confirmation').val().length;
    $('.password_confirmation').toggleClass('success_password_confirm', password_confirm >= 1);

    var sex = $('input:radio[name="sex"]:checked').val();
    $('.sex').toggleClass('success_sex', sex > 0);


    var old_year = $('select[name="old_year"]').val();
    $('select[name="old_year"]').toggleClass('success_year', old_year !== 'none');

    var old_month = $('select[name="old_month"]').val();
    $('select[name="old_month"]').toggleClass('success_month', old_month !== 'none');

    var old_day = $('select[name="old_day"]').val();
    $('select[name="old_day"]').toggleClass('success_day', old_day !== 'none');

    var role = $('input:radio[name="role"]:checked').val();
    $('.role').toggleClass('success_role', role > 0);


    if ($('.over_name').hasClass('success_name') &&
      $('.over_name_kana').hasClass('success_name_kana') &&
      $('.under_name').hasClass('success_under_name') &&
      $('.under_name_kana').hasClass('success_under_name_kana') &&
      $('.mail_address').hasClass('success_mail_address') &&
      $('.password').hasClass('success_password') &&
      $('.password_confirmation').hasClass('success_password_confirm') &&
      $('.sex').hasClass('success_sex') &&
      $('select[name="old_year"]').hasClass('success_year') &&
      $('select[name="old_month"]').hasClass('success_month') &&
      $('select[name="old_day"]').hasClass('success_day') &&
      $('.role').hasClass('success_role')) {

      $('.register_btn').prop('disabled', false);
    } else {
      $('.register_btn').prop('disabled', true);
    }
  });
});
