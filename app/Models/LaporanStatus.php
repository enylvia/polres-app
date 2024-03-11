<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanStatus extends Model
{
    use HasFactory;
    protected $table = 'laporan_status';
    public function Laporan():HasMany
    {
        return $this->hasMany(Laporan::class);
    }
}
