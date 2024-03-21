@extends('partial.adm_master')

@section('admin_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
        </div>
        <div class="card-body">
            @if(Auth::user()->id_user_role == 2)
            <div class="text-right py-3">
                <a href="{{route('laporan.export')}}" class="btn btn-sm btn-secondary">Cetak Laporan</a>
            </div>
            @endif
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
                @if(Auth::user()->id_user_role == 1)
                <div class="text-right py-3">
                    <a href="{{ route('laporan.create_data') }}" class="btn btn-sm btn-primary">Tambah Data</a>
                </div>
                @endif
            <div class="py-3">
                <form action="/data_laporan" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama user">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Laporan</th>
                            <th>Tanggal Laporan</th>
                            <th>Tanggal Hilang</th>
                            <th>Deskripsi</th>
                            @if(Auth::user()->id_user_role == 1)
                            <th>Status</th>
                            @endif
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporans as $key => $laporan)
                            <tr>
                                <td>{{ ($laporans->currentPage() - 1) * $laporans->perPage() + $key + 1 }}</td>
                                <td>{{ $laporan->no_laporan }}</td>
                                <td>{{ $laporan->tanggal_laporan }}</td>
                                <td>{{ $laporan->tanggal_hilang }}</td>
                                <td>{{ $laporan->deskripsi }}</td>
                                @if(Auth::user()->id_user_role == 1)
                                <td>
                                    @if($laporan->id_laporan_status == 1)
                                    <div class="btn btn-sm btn-warning">{{$laporan->LaporanStatus->status}}</div>
                                    @elseif($laporan->id_laporan_status == 2)
                                    <div class="btn btn-sm btn-primary">{{$laporan->LaporanStatus->status}}</div>
                                    @else
                                    <div class="btn btn-sm btn-success">{{$laporan->LaporanStatus->status}}</div>
                                    @endif
                                </td>
                                @endif
                                <td class="d-flex justify-content-end align-items-center">
                                        @if(Auth::user()->id_user_role == 2)
                                            <div class="mr-2">
                                                    <select class="form-control w-100" id="status">
                                                        <option value="1">Pending</option>
                                                        <option value="2">Proses</option>
                                                        <option value="3">Selesai</option>
                                                        <option value="4">Arsip</option>
                                                    </select>
                                            </div>
                                        @endif
                                    <div class="d-flex flex-column">
                                        @if(Auth::user()->id_user_role == 2)
                                            <a href="#" class="btn btn-sm btn-success mb-2" onclick="updateStatus('{{route('update.status',$laporan->id)}}')">Update</a>
                                        @endif
                                        <a href="{{ route('laporan.detail', $laporan->id) }}" class="btn btn-sm btn-primary mb-2">Detail</a>
                                        @if(Auth::user()->id_user_role == 1)
                                            <a href="#" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('laporan.delete', $laporan->id) }}')">Delete</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        <span class="results-text">
                            Showing {{ $laporans->firstItem() }} to {{ $laporans->lastItem() }} of {{ $laporans->total() }} results
                        </span>

                        <ul class="pagination-list">
                            @if ($laporans->onFirstPage())
                                <li class="disabled">Previous</li>
                            @else
                                <li>
                                    <a href="{{ $laporans->previousPageUrl() }}" rel="prev">Previous</a>
                                </li>
                            @endif

                            @if ($laporans->hasMorePages())
                                <li>
                                    <a href="{{ $laporans->nextPageUrl() }}" rel="next">Next</a>
                                </li>
                            @else
                                <li class="disabled">Next</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <script>
                    function confirmDelete(deleteUrl) {
                        if (confirm('Apakah Anda yakin ingin menghapus?')) {
                            window.location.href = deleteUrl;
                        }
                    }
                    function updateStatus(updateUrl) {
                        var selectedStatus = document.getElementById('status').value;

                        // Redirect ke URL
                        window.location.href = updateUrl + '?id_status=' + selectedStatus;
                    }
                </script>

@endsection

