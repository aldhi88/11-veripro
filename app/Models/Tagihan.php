<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
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
            "Dibatalkan", //0
            "Perubahan SP",//1
            "Dikirim ke User (Tahap 1)", //2
            "Revisi User (Tahap 1)", //3
            "Perbaikan ke User (Tahap 1)", //4
            "Disetujui User (Tahap 1)", //5
            "Revisi Procurement (Tahap 1)", //6
            "Perbaikan ke Procurement (Tahap 1)", //7
            "Disetujui Procurement (Tahap 1)", //8
            "Dikirim ke Procurement (Tahap 2)", //9
            "Revisi Procurement (Tahap 2)", //10
            "Perbaikan ke Procurement (Tahap 2)", //11
            "Selesai", //12
        ];

    }

    public static function dtDokTurnkey()
    {
        return [
            [
                'Sertifikat Quality Assurance (QA)',
                'Surat Keterangan dari Unit Quality & Infrastructure Development',
            ],
            'Sertifikat Hak Merek atau Surat Keterangan Terdaftar dari Kementrian Hukum dan HAM atau perjanjian lisensi atau royalty dari pemegang Hak Cipta, Hak Merek, atau Hak Paten',
            [
                'Surat keterangan lulus Quality Check (QC)',
                'Berita Acara Lulus Quality Check (QC) Ulang',
            ],
            'Certificate of origin',
            [
                'Surat Jalan/Delivery Order (DO) dari Produsen (Pabrik)',
                'Surat Jalan/Delivery Order (DO) dari supplier atau agen resmi',
            ]
        ];
    }

    public static function dtFileBa($index=null)
    {
        $fileName = [
            "0_surat_permohonan_uji_terima",
            "1_nota_dinas",
            "2_berita_acara_uji_terima",
            "3_lampiran_acara_uji_terima",
            "4_permohonan_rekon",
            "5_ba_penggunaan_material",
            "6_rekap_lampiran_ba_rekonsiliasi",
            "7_ba_rekonsiliasi_pekerjaan",
            "8_ba_rekon_penggunaan_material",
            "9_surat_pernyataan_material_turnkey",
            "10_ba_legalitas",
            "11_ba_gambar",
            "12_amandemen_penutup",
            "13_berita_acara_serah_terima",
            "14_surat_permohonan_bayar",
            "15_invoice",
            "16_kwitansi"
        ];

        if(is_null($index)){
            return $fileName;
        }
        return $fileName[$index];
    }
    public static function dtTitleBa($index=null)
    {
        $fileName = [
            "Surat Permohonan Uji Terima",
            "Nota Dinas",
            "Berita Acara Uji Terima",
            "Lampiran Acara Uji Terima",
            "Permohonan Rekon",
            "BA Penggunaan Material",
            "Rekap Lampiran BA Rekonsilisasi",
            "BA Rekonsiliasi Pekerjaan",
            "BA Rekon Penggunaan Material",
            "Surat Pernyataan Material Turnkey",
            "BA Legalitas",
            "BA Gambar",
            "Amandemen Penutup",
            "Berita Acara Serah Terima",
            "Surat Permohonan Bayar",
            "Invoice",
            "Kwitansi"
        ];

        if(is_null($index)){
            return $fileName;
        }
        return $fileName[$index];
    }
    public function sp_induks():BelongsTo
    {
        return $this->belongsTo(SpInduk::class,'sp_induk_id','id');
    }
    public function tagihan_histories():BelongsTo
    {
        return $this->belongsTo(TagihanHistory::class,'tagihan_history_id','id');
    }
    public function mitras():BelongsTo
    {
        return $this->belongsTo(AuthLogin::class,'mitra_id','id');
    }
    public function auth_logins():BelongsTo
    {
        return $this->belongsTo(AuthLogin::class,'auth_login_id','id');
    }
}
