Parsley.addMessages('id', {
    defaultMessage: "Tidak valid",
    type: {
      email:        "Email tidak valid",
      url:          "Url tidak valid",
      number:       "Nomor tidak valid",
      integer:      "Harus berupa integer",
      digits:       "Harus berupa digit",
      alphanum:     "Harus berupa alphanumeric"
    },
    notblank:       "Tidak boleh kosong",
    required:       "Tidak boleh kosong",
    pattern:        "Tidak valid",
    min:            "Harus lebih besar atau sama dengan %s.",
    max:            "Harus lebih kecil atau sama dengan %s.",
    range:          "Harus dalam rentang %s dan %s.",
    minlength:      "Terlalu pendek, minimal %s karakter atau lebih.",
    maxlength:      "Terlalu panjang, maksimal %s karakter atau kurang.",
    length:         "Panjang karakter harus dalam rentang %s dan %s",
    mincheck:       "Pilih minimal %s pilihan",
    maxcheck:       "Pilih maksimal %s pilihan",
    check:          "Pilih antar %s dan %s pilihan",
    equalto:        "Kata sandi tidak sama",
  });

  Parsley.addValidator('uppercase', {
    requirementType: 'number',
    validateString: function(value, requirement) {
    var uppercases = value.match(/[A-Z]/g) || [];
    return uppercases.length >= requirement;
  },
    messages: {
    // en: 'Your password must contain at least (%s) uppercase letter.'
    id: 'Kata sandi harus mengandung setidaknya (%s) huruf kapital'
  }
});

//has lowercase
Parsley.addValidator('lowercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var lowecases = value.match(/[a-z]/g) || [];
    return lowecases.length >= requirement;
  },
  messages: {
    // en: 'Your password must contain at least (%s) lowercase letter.'
    id: 'Kata sandi harus mengandung setidaknya (%s) huruf kecil'
  }
});

//has number
Parsley.addValidator('number', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var numbers = value.match(/[0-9]/g) || [];
    return numbers.length >= requirement;
  },
  messages: {
    // en: 'Your password must contain at least (%s) number.'
    id: 'Kata sandi harus mengandung setidaknya (%s) angka.'
  }
});

//has special char
Parsley.addValidator('special', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var specials = value.match(/[^a-zA-Z0-9]/g) || [];
    return specials.length >= requirement;
  },
  messages: {
    // en: 'Your password must contain at least (%s) special characters.'
    id: 'Kata sandi harus mengandung setidaknya (%s) karakter khusus.'
  }
});

  Parsley.setLocale('id');
