<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['id_laporan_status','id_user','id_kendaraan','no_laporan','tanggal_laporan','tanggal_hilang','deskripsi','is_arsip'];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class,'id_kendaraan');
    }

    public function LaporanStatus()
    {
        return $this->belongsTo(LaporanStatus::class,'id_laporan_status');
    }
}
