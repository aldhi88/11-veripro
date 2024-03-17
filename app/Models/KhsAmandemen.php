<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhsAmandemen extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function khs_induks():BelongsTo
    {
        return $this->belongsTo(KhsInduk::class, 'khs_induk_id', 'id');
    }

    public function khs_amandemen_designators():HasMany
    {
        return $this->hasMany(KhsAmandemenDesignator::class, 'khs_amandemen_id', 'id');
    }

    public function sp_induks():HasMany
    {
        return $this->hasMany(SpInduk::class, 'khs_amandemen_id', 'id');
    }

    public static function isAllowDelete($id)
    {
        $cekSp = SpInduk::where('khs_amandemen_id', $id)->get()->count();
        $tgl_berlaku = KhsAmandemen::select('tgl_berlaku')->where('id', $id)->value('tgl_berlaku');
        $cekAman = KhsAmandemen::where('tgl_berlaku','>=', $tgl_berlaku)
            ->where('id','!=',$id)
            ->get()->count();
        if($cekAman == 0 && $cekSp == 0){
            return true;
        }
        return false;
    }

    public static function isAllowEdit($id)
    {
        $cekSp = SpInduk::where('khs_amandemen_id', $id)->get()->count();
        $tgl_berlaku = KhsAmandemen::select('tgl_berlaku')->where('id', $id)->value('tgl_berlaku');
        $cekAman = KhsAmandemen::where('tgl_berlaku','>=', $tgl_berlaku)
            ->where('id','!=',$id)
            ->get()->count();
        if($cekAman == 0 && $cekSp == 0){
            return true;
        }
        return false;
    }
}
