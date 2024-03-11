@extends('partial.adm_master')

@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Kendaraan</h6>
        </div>
        <div class="card-body">
            <div class="text-right py-3">
                <a href="{{route('edit.kendaraan',$kendaraan->id)}}" class="btn btn-sm btn-warning">Edit Data</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Merk:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->merk }}</dd>

                        <dt class="col-sm-4">Model:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->model }}</dd>

                        <dt class="col-sm-4">Warna:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->warna }}</dd>

                        <dt class="col-sm-4">Nomor Polisi:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->nomor_polisi }}</dd>

                        <dt class="col-sm-4">No Rangka:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->no_rangka }}</dd>

                        <dt class="col-sm-4">No Mesin:</dt>
                        <dd class="col-sm-8">{{ $kendaraan->no_mesin }}</dd>
                    </dl>
                </div>
            </div>

            <hr class="py-3">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Scan BPKB:</dt>
                        <dd class="col-sm-8">
                            @if($kendaraan->scan_bpkb)
                                <img src="{{ asset($kendaraan->scan_bpkb) }}" alt="Scan BPKB" style="width: 250px; margin-bottom: 25px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>

                        <dt class="col-sm-4">Scan STNK:</dt>
                        <dd class="col-sm-8">
                            @if($kendaraan->scan_stnk)
                                <img src="{{ asset($kendaraan->scan_stnk) }}" alt="Scan STNK" style="width: 250px;">
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
                            @if($kendaraan->foto_ktp)
                                <img src="{{ asset($kendaraan->foto_ktp) }}" alt="Foto KTP" style="width: 250px; margin-bottom: 25px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>

                        <dt class="col-sm-4">Foto Kendaraan:</dt>
                        <dd class="col-sm-8">
                            @if($kendaraan->foto_kendaraan)
                                <img src="{{ asset($kendaraan->foto_kendaraan) }}" alt="Foto Kendaraan" style="width: 250px;">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>


            <div class="text-right mt-4">
                <a href="/user/data_kendaraan" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
