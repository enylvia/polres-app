@extends('partial.adm_master')

@section('admin_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kendaraan</h6>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="text-right py-3">
                <a href="/user/create_data_kendaraan" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Warna</th>
                        <th>Nomor Polisi</th>
                        <th>No Rangka</th>
                        <th>No Mesin</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kendaraans as $key => $kendaraan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kendaraan->merk }}</td>
                            <td>{{ $kendaraan->model }}</td>
                            <td>{{ $kendaraan->warna }}</td>
                            <td>{{ $kendaraan->nomor_polisi }}</td>
                            <td>{{ $kendaraan->no_rangka }}</td>
                            <td>{{ $kendaraan->no_mesin }}</td>
                            <td class="d-flex align-items-center">
                                <a href="{{route('detail.kendaraan',$kendaraan->id)}}" class="btn btn-sm btn-primary mr-2">Detail</a>

                                <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete('{{route('delete.kendaraan',$kendaraan->id)}}')">Delete</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
    function confirmDelete(deleteUrl) {
        if (confirm('Apakah Anda yakin ingin menghapus?')) {
            window.location.href = deleteUrl;
        }
    }
</script>
@endsection

