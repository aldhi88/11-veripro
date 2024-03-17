<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;



class AuthLogin extends Authenticatable
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'password',
    ];
    
    public function master_users():HasOne
    {
        return $this->hasOne(MasterUser::class, 'auth_login_id', 'id');
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
