@extends('partial.adm_master')

@section('admin_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User Pelapor</h6>
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
                <div class="py-3">
                    <form action="/admin/data_user" method="GET">
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
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('edit.user', $user->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                        <span class="results-text">
                            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                        </span>

                    <ul class="pagination-list">
                        @if ($users->onFirstPage())
                            <li class="disabled">Previous</li>
                        @else
                            <li>
                                <a href="{{ $users->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        @if ($users->hasMorePages())
                            <li>
                                <a href="{{ $users->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="disabled">Next</li>
                        @endif
                    </ul>
                </div>
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
