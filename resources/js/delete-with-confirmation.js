var initDeleteHandler = function () {
  $(document).on('click', '.buttons-delete', function (e) {
    e.preventDefault();
    var url, tid, target;

    target = e.target;
    url = $(target).closest('a').prop('href');
    tid = $(target).closest('a').attr('id');
    tid ? tid = $(target).attr('id') : tid = 'delete-with-confirmation';

    Swal.fire({
      title: 'Anda yakin?',
      text: "Data yang sudah dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: 'delete',
          url,
          error: function (err) {
            console.error('delete with confirmation', err, 'tid:', tid)
            $.event.trigger(`${tid}.error`, err)
          },
          success: function (res) {
            console.info('delete with confirmation', res, 'tid:', tid)
            $.event.trigger(`${tid}.success`, res)
          }
        })
      }
    })
    $(this).off()
  });
}


$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  initDeleteHandler();
})