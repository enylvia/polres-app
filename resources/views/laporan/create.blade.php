@extends('partial.adm_master')

@section('admin_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Laporan Kendaraan Hilang</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_kendaraan">Kendaraan:</label>
                        <select class="form-control" id="id_kendaraan" name="id_kendaraan" required>
                            @foreach($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}">{{ $kendaraan->merk . ' ' . $kendaraan->model }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        @error('tanggal_laporan')
                            <small>{{ $message }}</small>
                        @enderror
                        <label for="tanggal_laporan">Tanggal Laporan:</label>
                        <input type="date" class="form-control" id="tanggal_laporan" value="{{ date('Y-m-d') }}" name="tanggal_laporan" required>
                    </div>
                    <div class="form-group col-md-6">
                        @error('tanggal_hilang')
                            <small>{{ $message }}</small>
                        @enderror
                        <label for="tanggal_hilang">Tanggal Hilang:</label>
                        <input type="date" class="form-control" id="tanggal_hilang" name="tanggal_hilang" required>
                    </div>
                </div>
                <div class="form-group">
                    @error('alamat_pelapor')
                        <small>{{ $message }}</small>
                    @enderror
                    <label for="alamat_pelapor">Alamat Pelapor:</label>
                    <textarea class="form-control" id="alamat_pelapor" name="alamat_pelapor" rows="3" required placeholder="Jln.. Gg.."></textarea>
                </div>
                <div class="form-group">
                    @error('deskripsi')
                        <small>{{ $message }}</small>
                    @enderror
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Lokasi terakhir motor ... di jam ..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
