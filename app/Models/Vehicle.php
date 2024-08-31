<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol',
        'no_rangka',
        'model',
        'warna',
        'tgl_dec',
        'bulan_dec',
        'masa_pakai',
        'tanggal_last_service',
        'km_sekarang',
        'tanggal_next_service',
        'note',
        'tgl_bp',
        'no_spk',
        'tgl_spk',
        'harga',
        'diskon',
        'customer',
        'tgl_bpkb',
        'tgl_terima',
        'tgl_spb',
        'tgl_stnk',
        'asuransi',
        'aktif_tanggal',
    ];

    // Accessor untuk menghitung masa pakai
    public function getMasaPakaiAttribute()
    {
        if ($this->tgl_dec) {
            $startDate = Carbon::parse($this->tgl_dec);
            $now = Carbon::now();

            $years = $now->diffInYears($startDate);
            $months = $now->diffInMonths($startDate) % 12;

            return "{$years} tahun, {$months} bulan";
        }

        return null;
    }
}
