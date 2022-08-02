@foreach ($tamu->dokumen as $dokumen)
@php
    $original = $dokumen['nama'];
    $replace = str_replace('_', ' ', $original);
@endphp
<div class="my-1">
    <a href="#modal-dokumen"  data-toggle="modal" class="btn btn-dark btn-sm" style="text-transform: {{ ($replace == 'ktp' ?  'uppercase' : 'capitalize') }}; align-items:center">{{ $replace }}<a>
</div>

<div class="modal fade" id="modal-dokumen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dokumen Tamu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               <img src="{{ $dokumen['public_url'] }}" alt="KTP {{ $tamu->nama }}" class="w-100">
            </div>
        </div>
    </div>
</div>
@endforeach
