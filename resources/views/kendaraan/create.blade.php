@extends('partial.adm_master')

@section('admin_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kendaraan Hilang</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kendaraan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="merk">Merk:</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="model">Model:</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="warna">Warna:</label>
                        <input type="text" class="form-control" id="warna" name="warna" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_rangka">No Rangka:</label>
                        <input type="text" class="form-control" id="no_rangka" name="no_rangka" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="no_mesin">Nomor Mesin:</label>
                        <input type="text" class="form-control" id="no_mesin" name="no_mesin" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nomor_polisi">Nomor Polisi:</label>
                        <input type="text" class="form-control" id="nomor_polisi" name="nomor_polisi" required>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="scan_bpkb">Scan BPKB:</label>
                        <input type="file" class="form-control-file" id="scan_bpkb" name="scan_bpkb">
                        <img id="scan_bpkb_preview" src="#" alt="Scan BPKB Preview" style="display:none; width: 150px; margin-top: 10px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="scan_stnk">Scan STNK:</label>
                        <input type="file" class="form-control-file" id="scan_stnk" name="scan_stnk">
                        <img id="scan_stnk_preview" src="#" alt="Scan STNK Preview" style="display:none; width: 150px; margin-top: 10px;">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="foto_ktp">Foto KTP:</label>
                        <input type="file" class="form-control-file" id="foto_ktp" name="foto_ktp">
                        <img id="foto_ktp_preview" src="#" alt="Foto KTP Preview" style="display:none; width: 150px; margin-top: 10px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="foto_kendaraan">Foto Kendaraan:</label>
                        <input type="file" class="form-control-file" id="foto_kendaraan" name="foto_kendaraan">
                        <img id="foto_kendaraan_preview" src="#" alt="Foto Kendaraan Preview" style="display:none; width: 150px; margin-top: 10px;">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        document.getElementById('scan_bpkb').addEventListener('change', function () {
            previewImage(this, 'scan_bpkb_preview');
        });

        document.getElementById('scan_stnk').addEventListener('change', function () {
            previewImage(this, 'scan_stnk_preview');
        });

        document.getElementById('foto_ktp').addEventListener('change', function () {
            previewImage(this, 'foto_ktp_preview');
        });

        document.getElementById('foto_kendaraan').addEventListener('change', function () {
            previewImage(this, 'foto_kendaraan_preview');
        });
    </script>
@endsection
