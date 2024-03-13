@extends('partial.log_master')

@section('log_content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Silahkan Register</h1>
    </div>
    <div class="user">
        <form action="/sesi/create" method="POST">
            @csrf
            <div class="form-group">
                <input type="name" value="{{ Session::get('name') }}" class="form-control" name="name"
                    placeholder="Masukan Nama Anda">
                @error('name')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="nik" value="{{ Session::get('nik') }}" class="form-control" name="nik"
                    placeholder="Masukan Nik Anda">
                @error('nik')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="phone_number" value="{{ Session::get('phone_number') }}" class="form-control" name="phone_number"
                    placeholder="Masukan Nomor Telepon Anda">
                @error('phone_number')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" value="{{ Session::get('email') }}" class="form-control" name="email"
                    placeholder="Masukan Email Anda">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @error('password')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <button name="submit" type="submit" class="btn btn-primary btn-user btn-block">Register</button>

        </form>
    </div>

    <hr>
    <div class="text-center">
        <a class="small" href="#">Buat Akun!</a>
    </div>
@endsection
