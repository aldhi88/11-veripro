<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagihanHistory extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = [
        'status_label',
        'status_desc',
    ];

    public function getStatusDescAttribute()
    {
        if($this->status == 0){
            return 'SP & Tagihan Dibatalkan oleh Procurement';
        }elseif($this->status == 1){
            return 'Procurement melakukan perubahan data SP';
        }elseif($this->status == 2){
            return 'Mitra mengirim Tagihan ke User';
        }elseif($this->status == 3){
            return 'User mingirim revisi Tagihan ke Mitra';
        }elseif($this->status == 4){
            return 'Mitra mengirim perbaikan Tagihan ke User';
        }elseif($this->status == 5){
            return 'User menyetujui Tagihan dan diteruskan ke Procurement';
        }elseif($this->status == 6){
            return 'Procurement mengirimkan revisi Tagihan Tahap 1 ke Mitra';
        }elseif($this->status == 7){
            return 'Mitra mengirimkan perbaikan Tagihan Tahap 1 ke Procurement';
        }elseif($this->status == 8){
            return 'Tagihan Tahap 1 disetujui, tagihan dikembalikan ke Mitra untuk dilanjutkan ke Tagihan Tahap 2';
        }elseif($this->status == 9){
            return 'Mitra mengirimkan data Tagihan Tahap 2';
        }elseif($this->status == 10){
            return 'Procurement mengirimkan revisi Tagihan Tahap 2 ke Mitra';
        }elseif($this->status == 11){
            return 'Mitra mengirimkan perbaikan Tagihan Tahap 2 ke Procurement';
        }else{
            return 'Tagihan sudah benar, disetujui dan selesai';
        }
    }

    public function getStatusLabelAttribute()
    {
        if($this->status == 0){
            return '<h5 class="mb-0"><span class="w-100 badge badge-dark">Dibatalkan</span></h5>';
        }elseif($this->status == 1){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Perubahan SP</span></h5>';
        }elseif($this->status == 2){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Dikirim ke User (Tahap 1)</span></h5>';
        }elseif($this->status == 3){
            return '<h5 class="mb-0"><span class="w-100 badge badge-danger">Revisi User</span></h5>';
        }elseif($this->status == 4){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Perbaikan ke User</span></h5>';
        }elseif($this->status == 5){
            return '<h5 class="mb-0"><span class="w-100 badge badge-success">Disetujui User</span></h5>';
        }elseif($this->status == 6){
            return '<h5 class="mb-0"><span class="w-100 badge badge-danger">Revisi Procurement (Tahap 1)</span></h5>';
        }elseif($this->status == 7){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Perbaikan ke Procurement (Tahap 1)</span></h5>';
        }elseif($this->status == 8){
            return '<h5 class="mb-0"><span class="w-100 badge badge-success">Disetujui Procurement (Tahap 1)</span></h5>';
        }elseif($this->status == 9){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Dikirim ke Procurement (Tahap 2)</span></h5>';
        }elseif($this->status == 10){
            return '<h5 class="mb-0"><span class="w-100 badge badge-danger">Revisi Procurement (Tahap 2)</span></h5>';
        }elseif($this->status == 11){
            return '<h5 class="mb-0"><span class="w-100 badge badge-info">Perbaikan ke Procurement (Tahap 2)</span></h5>';
        }else{
            return '<h5 class="mb-0"><span class="w-100 badge badge-success">Selesai</span></h5>';
        }
    }
    
    static function dtStatus()
    {
        return [
            "Dibatalkan",
            "Perubahan SP",
            "Dikirim ke User (Tahap 1)",
            "Revisi User",
            "Perbaikan ke User",
            "Disetujui User",
            "Revisi Procurement (Tahap 1)",
            "Perbaikan ke Procurement (Tahap 1)",
            "Disetujui Procurement (Tahap 1)",
            "Dikirim ke Procurement (Tahap 2)",
            "Revisi Procurement (Tahap 2)",
            "Perbaikan ke Procurement (Tahap 2)",
            "Selesai",
        ];

    }

    public function tagihans():BelongsTo
    {
        return $this->belongsTo(Tagihan::class,'tagihan_id','id');
    }
}
