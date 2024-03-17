<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhsInduk extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function khs_amandemens():HasMany
    {
        return $this->hasMany(KhsAmandemen::class, 'khs_induk_id', 'id');
    }
    public function khs_induk_designators():HasMany
    {
        return $this->hasMany(KhsIndukDesignator::class, 'khs_induk_id', 'id');
    }
    public function auth_logins():BelongsTo
    {
        return $this->belongsTo(AuthLogin::class, 'auth_login_id', 'id');
    }
    
    public function sp_induks():HasMany
    {
        return $this->hasMany(SpInduk::class, 'khs_induk_id','id');
    }

    public static function isAllowDelete($id)
    {
        $cekAman = KhsAmandemen::where('khs_induk_id', $id)->get()->count();
        $cekSp = SpInduk::where('khs_induk_id', $id)->get()->count();
        if($cekSp == 0 && $cekAman == 0){
            return true;
        }
        return false;
    }

    public static function isAllowEdit($id)
    {
        $cekAman = KhsAmandemen::where('khs_induk_id', $id)->get()->count();
        $cekSp = SpInduk::where('khs_induk_id', $id)->get()->count();
        if($cekSp == 0 && $cekAman == 0){
            return true;
        }
        return false;
    }
}
