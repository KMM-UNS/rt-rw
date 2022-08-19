@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Data Pembayaran') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <br />
                        <br />
                        <form action="{{ route('user.kepala-keluarga.bayar-iurankondisional.store') }}" id="form"
                            name="form" method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                            @csrf
                            @if (isset($datas))
                                {{ method_field('PUT') }}
                            @endif
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1 my-auto">
                                        <label for="bulan"><strong>Pilih Bulan</strong></label>
                                    </div>
                                    <div class="col-md-3 ">
                                        <select name="bulan" class="form-control" required="required">
                                            <option value="">Select Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="1">July</option>
                                            <option value="2">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label for="tahun"><strong>Pilih Tahun</strong></label>
                                    </div>
                                    <div class="col-md-3 ">
                                        <select style="" class="form-control" id="tag_select" name="tahun">
                                            <option value="0" selected disabled> Pilih Tahun</option>
                                            <?php
                                            $year = date('Y');
                                            $min = $year - 2;
                                            $max = $year;
                                            for ($i = $max; $i >= $min; $i--) {
                                                echo '<option value=' . $i . '>' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-search"></span>
                                Search</button>
                        </form>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table border="1" cellpadding="2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No KK</th>
                                        <th scope="col">Kepala Keluarga</th>
                                        <th scope="col">Pos Tagihan</th>
                                        <th scope="col">Telp</th>
                                        <th scope="col">Denda Ronda</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($wargaa as $item)
                                        <tr>
                                            <td>{{ $item->no_kk }}</td>
                                            <td>{{ $item->warga }}</td>
                                            <td>{{ $item->pos->nama }}</td>
                                            <td>{{ $item->telp }}</td>
                                            @php
                                                $status1 = $item->warga_kondisional->where('jenis_iuran_id', 1);
                                                // $status2 = $item->warga_kondisional->where('jenis_iuran_id', 2);
                                            @endphp
                                            <td>
                                                @foreach ($status1 as $j)
                                                    <p>{{ date('d M Y', strtotime($j->tanggal)) }}</p>
                                                @endforeach
                                                <label for=""
                                                    class="label {{ count($status1) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status1) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                            </td>
                                            {{-- <td>
                                                @foreach ($status2 as $i)
                                                    <p>{{ date('d M Y', strtotime($i->tanggal)) }}</p>
                                                @endforeach
                                                <label for=""
                                                    class="label {{ count($status2) != 0 ? 'label-success' : 'label-danger center' }}">{{ count($status2) != 0 ? 'Sudah Bayar' : 'Belum Bayar' }}</label>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    </body>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpush
