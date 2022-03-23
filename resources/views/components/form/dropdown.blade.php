<select class="select2 form-control" name="{{ $name }}" id="{{ $name }}" data-select2-id="select2-data-{{ $name }}" tabindex="-1" aria-hidden="true" aria-required="true" {{ $attributes }}>
    @if(!$attributes['multiple'])
    <option value="" @if(empty($selected)) selected @endif>{{ $placeholder ?? 'Pilih' }}</option>
    @endif
    @foreach($options as $key => $option)
    @if(is_array($selected))
    <option value="{{ $key }}" {{ (isset($selected) && in_array($key, $selected)) ? 'selected' : null }}>{{ $option }}</option>
    @else
    <option value="{{ $key }}" {{ (isset($selected) && $selected == $key) ? 'selected' : null }}>{{ $option }}</option>
    @endif
    @endforeach
</select>

@push('css')
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{ asset('/assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script>
    function initSelect2() {
        "use strict";
        $('select.select2').select2({});
    }

    //helper
    function select2DataFormat(arr = [], textKey = 'name') {
        return arr.map(item => {
            return {
                text: item[textKey],
                ...item
            }
        });
    }

    function select2Empty(element) {
        element.children('option[value!=""]').remove();
    }

    $(function() {
        initSelect2();
    })
</script>
@endpush