var initFormHandler = function () {
  let form = $('form');

  form.on('submit', e => {
    let tid, data, action, method, target;
    e.preventDefault();
    target = e.target;
    data = $(target).serializeArray();
    action = $(target).prop('action');
    method = $(target).prop('method');

    tid = $(target).attr('id');
    (!tid) ? tid = $(target).attr('name') : 'form.submit';

    $.ajax({
      url: action,
      method,
      data,
      error: function (err) {
        console.error('form submit', err, 'tid:', tid)
        $.event.trigger(`${tid}.error`, err)
      },
      success: function (res) {
        console.info('form submit', res, 'tid:', tid)
        $.event.trigger(`${tid}.success`, res)
      }
    })
  })
}


$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  initFormHandler();
});