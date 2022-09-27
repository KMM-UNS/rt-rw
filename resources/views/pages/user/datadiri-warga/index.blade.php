@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">Data Diri @yield('title')</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        @if (empty($data) || $data->count() == 0)
                            <!-- begin panel -->
                            <div class="panel panel-inverse">
                                <div class="panel-body mx-3 text-center">
                                    <h3>Data Keluarga</h3>
                                    <hr>
                                    <p style="font-size: 14px">Anda belum mengisi data keluarga.</p>
                                    <a href="{{ route('user.warga.data-diri.create') }}" class="btn btn-primary"><i
                                            class="fas fa-pencil-alt fa-fw mr-2"></i>Isi Data Keluarga</a>
                                </div>
                            </div>
                            <!-- end panel -->
                        @else
                            <div class="panel-body">
                                <form action="{{ route('user.warga.data-diri.store') }}" id="form" name="form"
                                    method="POST" data-parsley-validate="true" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($data))
                                        {{ method_field('PUT') }}
                                    @endif
                                    <!-- begin panel-body -->
                                    <div class="panel-body">
                                        {{-- <a href="{{ url('warga/data-diri/create') }}" class="btn btn-success">CREATE</a> --}}

                                        <div class="row">
                                            <div class="col">
                                                <img src="/assets/img/user/user-1.jpg" alt="Foto Warga" width="200">
                                            </div>
                                            <div class="col">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> </th>
                                                            <th scope="col"> </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($data as $item) --}}
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td> {{ Auth::user()->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No.KK</td>
                                                            <td>{{ $data['no_kk'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No. Telepon</td>
                                                            <td>{{ $data['telp'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pos</td>
                                                            <td>{{ $data->postagihan->nama }}</td>
                                                        </tr>
                                                        {{-- @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="{{ route('user.warga.data-diri.edit', $data->id) }}"
                                            class="btn btn-success">Edit</a>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
