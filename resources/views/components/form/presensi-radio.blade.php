<div>
    <label class="radio-inline">
        <input required="" type="radio" name="{{ $name }}" id="presensi-H" value="hadir" aria-required="true" class="valid" {{ old($name) == 'hadir' ? "checked" : (isset($selected) && $selected == 'hadir' ? "checked" : null ) }}>
        <span>Hadir</span>
    </label>
    <label class="radio-inline">
        <input required="" type="radio" name="{{ $name }}" id="presensi-TH" value="tidak hadir" aria-required="true" class="valid" {{ old($name) == 'tidak hadir' ? "checked" : (isset($selected) && $selected == 'tidak hadir' ? "checked" : null ) }}>
        <span>Tidak Hadir</span>
    </label>
</div>
