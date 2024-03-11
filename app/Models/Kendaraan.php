<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = ['id_user','merk','model','warna','nomor_polisi','no_rangka',
        'no_mesin','scan_bpkb','scan_stnk','foto_ktp','foto_kendaraan'];
    public function Laporan(): HasOne
    {
        return $this->hasOne(Laporan::class);
    }
    public function User(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
