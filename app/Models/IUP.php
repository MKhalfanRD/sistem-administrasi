<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class IUP extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaPerusahaan',
        'alamat',
        'npwp',
        'nib',
        'kabupaten',
        'luasWilayah',
        'tahapanKegiatan',
        'noSK_wiup',
        'noSK_eksplor',
        'noSK_op',
        'noSK_p1',
        'noSK_p2',
        'masaBerlaku_eksplor',
        'masaBerlaku_op',
        'masaBerlaku_p1',
        'masaBerlaku_p2',
        'tanggalSK_wiup',
        'tanggalSK_eksplor',
        'tanggalSK_op',
        'tanggalSK_p1',
        'tanggalSK_p2',
        'tanggalBerakhir_eksplor',
        'tanggalBerakhir_op',
        'tanggalBerakhir_p1',
        'tanggalBerakhir_p2',
        'komoditas',
        'lokasiIzin',
        'statusIzin',
        'scanSK'
    ];

    public function wiup(): HasOne
    {
        return $this->hasOne(WIUP::class);
    }

    // Relasi dengan model Eksplorasi
    public function eksplorasi(): HasOne
    {
        return $this->hasOne(Eksplorasi::class);
    }

    // Relasi dengan model OperasiProduksi
    public function operasiProduksi(): HasOne
    {
        return $this->hasOne(OperasiProduksi::class);
    }

    // Relasi dengan model Perpanjangan1
    public function perpanjangan1(): HasOne
    {
        return $this->hasOne(Perpanjangan1::class);
    }

    // Relasi dengan model Perpanjangan2
    public function perpanjangan2(): HasOne
    {
        return $this->hasOne(Perpanjangan2::class);
    }


    public function getStatusIzin($tahapanKegiatan)
{
    switch ($tahapanKegiatan) {
        case 'WIUP':
            return $this->wiup->getStatusIzin($tahapanKegiatan);
        case 'IUP Tahap Eksplorasi':
            return $this->eksplorasi->getStatusIzin($tahapanKegiatan);
        case 'IUP Tahap Operasi Produksi':
            return $this->operasiProduksi->getStatusIzin($tahapanKegiatan);
        case 'Perpanjangan 1 IUP Tahap Operasi Produksi':
            return $this->perpanjangan1->getStatusIzin($tahapanKegiatan);
        case 'Perpanjangan 2 IUP Tahap Operasi Produksi':
            return $this->perpanjangan2->getStatusIzin($tahapanKegiatan);
        default:
            return 'Tidak Diketahui';
    }
}

}
