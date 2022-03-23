window.handleWilayahSelectEvent = (provinsiSelector, kabupatenSelector, kecamatanSelector, kelurahanSelector) => {
  const provinsi = $(provinsiSelector);
  const kabupaten = $(kabupatenSelector);
  const kecamatan = $(kecamatanSelector);
  const kelurahan = $(kelurahanSelector);
  const baseurl = `${window.location.origin}/api/v1/references/wilayah/`;

  provinsi.on('select2:select', async function (e) {
    const data = e.params.data;
    const provinsi_id = data?.id;

    if (isEmptyString(provinsi_id)) {
      kabupaten.val(null).trigger('change');
      return
    }

    const kabupaten_data = await $.getJSON(baseurl + 'kabupaten', {
      provinsi_id,
      pluck: false
    }).then((data) => select2DataFormat(data));

    select2Empty(kabupaten);
    kabupaten.select2({
      data: kabupaten_data
    })

    kecamatan.val(null).trigger('change');
    kelurahan.val(null).trigger('change');
  });

  kabupaten.on('select2:select', async function (e) {
    const data = e.params.data;
    const kabupaten_id = data?.id;

    if (isEmptyString(kabupaten_id)) {
      kecamatan.val(null).trigger('change');
      return
    }

    const kecamatan_data = await $.getJSON(baseurl + 'kecamatan', {
      kabupaten_id,
      pluck: false
    }).then((data) => select2DataFormat(data));

    select2Empty(kecamatan);
    kecamatan.select2({
      data: kecamatan_data
    });

    kelurahan.val(null).trigger('change');
  });

  kecamatan.on('select2:select', async function (e) {
    const data = e.params.data;
    const kecamatan_id = data?.id;

    if (isEmptyString(kecamatan_id)) {
      kelurahan.val(null).trigger('change');
      return
    }

    const kelurahan_data = await $.getJSON(baseurl + 'kelurahan', {
      kecamatan_id,
      pluck: false
    }).then((data) => select2DataFormat(data));

    select2Empty(kelurahan);
    kelurahan.select2({
      data: kelurahan_data
    });
  });
}