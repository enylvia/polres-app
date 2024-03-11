@extends('partial.adm_master')

@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Kendaraan</h6>
        </div>
        <div class="card-body">
            @if(Auth::user()->id_user_role == 1)
            <div class="text-right py-3">
                <a href="{{route('laporan.edit',$laporan->id)}}" class="btn btn-sm btn-warning">Edit Data</a>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">No Laporan:</dt>
                        <dd class="col-sm-8">{{ $laporan->no_laporan }}</dd>

                        <dt class="col-sm-4">Tanggal Lapor:</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('Y F d') }}</dd>

                        <dt class="col-sm-4">Tanggal Hilang:</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($laporan->tangal_hilang)->format('Y F d') }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Merk :</dt>
                        <dd class="col-sm-8">{{ $laporan->kendaraan->merk }}</dd>

                        <dt class="col-sm-4">Type :</dt>
                        <dd class="col-sm-8">{{ $laporan->kendaraan->model }}</dd>

                        <dt class="col-sm-4">Warna :</dt>
                        <dd class="col-sm-8">{{ $laporan->kendaraan->warna }}</dd>
                    </dl>
                </div>
            </div>

            <hr class="py-3">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Scan BPKB:</dt>
                        <dd class="col-sm-8">
                            @if($laporan->kendaraan->scan_bpkb)
                                <img src="{{ asset($laporan->kendaraan->scan_bpkb) }}" alt="Scan BPKB" style="width: 250px; margin-bottom: 25px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>

                        <dt class="col-sm-4">Scan STNK:</dt>
                        <dd class="col-sm-8">
                            @if($laporan->kendaraan->scan_stnk)
                                <img src="{{ asset($laporan->kendaraan->scan_stnk) }}" alt="Scan STNK" style="width: 250px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Foto KTP:</dt>
                        <dd class="col-sm-8">
                            @if($laporan->kendaraan->foto_ktp)
                                <img src="{{ asset($laporan->kendaraan->foto_ktp) }}" alt="Foto KTP" style="width: 250px; margin-bottom: 25px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>

                        <dt class="col-sm-4">Foto Kendaraan:</dt>
                        <dd class="col-sm-8">
                            @if($laporan->kendaraan->foto_kendaraan)
                                <img src="{{ asset($laporan->kendaraan->foto_kendaraan) }}" alt="Foto Kendaraan" style="width: 250px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="text-right mt-4">
                <a href="/user/data_laporan" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
