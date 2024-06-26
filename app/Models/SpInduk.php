<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpInduk extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        if($this->status == 0){
            return '<h5 class="mb-0"><span class="badge w-100 badge-dark">Batal</span></h5>';
        }elseif($this->status == 1){
            return '<h5 class="mb-0"><span class="badge w-100 badge-info">Baru</span></h5>';
        }elseif($this->status == 2){
            return '<h5 class="mb-0"><span class="badge w-100 badge-primary">Proses</span></h5>';
        }else{
            return '<h5 class="mb-0"><span class="badge w-100 badge-success">Selesai</span></h5>';
        }
    }
    static function dtStatus()
    {
        return [
            "Batal",
            "Baru",
            "Proses",
            "Selesai",
        ];
    }

    public static function hasAman($id)
    {
        $return = true;
        $cekAman = SpAmandemen::where('sp_induk_id', $id)->count();
        if($cekAman==0){
            $return = false;
        }

        return $return;
    }

    public static function hasTagihan($id)
    {
        $return = false;
        $cekTagihan = Tagihan::where('sp_induk_id', $id)
            ->count();
        if($cekTagihan > 0){
            $return = true;
        }

        return $return;
    }

    public static function hasTagihanDone($id)
    {
        $return = false;
        $cekTagihan = Tagihan::where('sp_induk_id', $id)
            ->where('status','>',11)
            ->count();
        if($cekTagihan > 0){
            $return = true;
        }

        return $return;
    }

    public static function hasSpDone($id)
    {
        $return = false;
        $cekTagihan = SpInduk::where('id', $id)
            ->where('status','=',3)
            ->count();
        if($cekTagihan > 0){
            $return = true;
        }

        return $return;
    }

    public static function allowCreateAman($id)
    {
        //SP induk status baru / 1
        $return = false;
        if(
            !SpInduk::hasTagihanDone($id) &&
            !SpInduk::hasSpDone($id)
        ){
            $return=true;
        }
        return $return;
    }

    public static function allowEdit($id)
    {
        $return = false;
        if(
            !SpInduk::hasAman($id) && 
            !SpInduk::hasTagihanDone($id) &&
            !SpInduk::hasSpDone($id)
        ){
            $return=true;
        }
        return $return;
    }

    public static function allowDelete($id)
    {
        $return = false;
        
        if(
            !SpInduk::hasAman($id) &&
            !SpInduk::hasTagihan($id)
        ){
            $return = true;
        }

        return $return;
    }

    public function khs_amandemens():BelongsTo
    {
        return $this->belongsTo(KhsAmandemen::class,'khs_amandemen_id', 'id');
    }
    public function master_units():BelongsTo
    {
        return $this->belongsTo(MasterUnit::class,'master_unit_id', 'id');
    }
    public function khs_induks():BelongsTo
    {
        return $this->belongsTo(KhsInduk::class,'khs_induk_id', 'id');
    }
    public function auth_logins():BelongsTo
    {
        return $this->belongsTo(AuthLogin::class,'auth_login_id', 'id');
    }
    public function sp_amandemens():HasMany
    {
        return $this->hasMany(SpAmandemen::class,'sp_induk_id', 'id');
    }

    
}
