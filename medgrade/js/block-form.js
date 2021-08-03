$(document).ready(function () {
  var $blockForm = $('.block-form');
  var $name = $('#form-name');
  var $message = $('#form-message');
  var $email = $('#form-email');
  var $phone = $('#form-phone');
  var $privacy = $('#form-privacy');
  var $response = $blockForm.find('.response');
  var product = '';
  var $submit = $('.form-submit');

  $phone.on('input', function() {
    $phone.removeClass('error');
  });

  $privacy.on('change', function() {
    $submit.removeClass('disabled').addClass(this.checked ? '' : 'disabled')
  });

  $blockForm.add($blockForm.find('.close-icon')).on('click', function (e) {
    e.stopPropagation();
    $blockForm.removeClass('active');
  });

  $('.open-form').on('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $blockForm.addClass('active');
    product = this.getAttribute('product');
  });

  $('.form').on('click', function (e) {
    e.stopPropagation();
  });

  $submit.on('click', function (e) {
    e.stopPropagation();
    if ($phone.val() !== '' && $privacy.prop('checked')) {
      $.ajax({
        type: 'post',
        url: global_params.ajaxurl,
        data: {
          action: 'medgrade_send_form_data',
          name: $name.val(),
          email: $email.val(),
          phone: $phone.val(),
          message: $message.val(),
          product: product,
        },
        beforeSend: function () {
          yaCounter49000832.reachGoal('sendform1', {product: product});
          ga('send', 'event', {
            eventCategory: 'sendform1',
            dimension1: product,
          });
          $blockForm.addClass('waiting');
        },
        success: function (result) {
          $response.text(result ? 'Заявка успешно отправлена!' : 'Не удалось отправить заявку');
        },
        error: function(error) {
          $response.text('Не удалось отправить заявку')
        },
        complete: function () {
          $blockForm.removeClass('waiting').addClass('show-response');
          setTimeout(function() {
            $name.val('');
            $email.val('');
            $phone.val('');
            $message.val('');
            $response.text('');
            $privacy.prop('checked', true);
            $submit.removeClass('disabled');
            product = '';
            $blockForm.removeClass('active');
          }, 2000)
        }
      });
    }
    else {
      $phone.addClass('error');
    }
  })
});
