<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpAmandemen extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public static function allowEditDelete($id)
    {
        $return = false;
        $spIndukId = SpAmandemen::select('sp_induk_id')
            ->where('id',$id)
            ->first()
            ->getAttribute('sp_induk_id');
        
        $idCek = SpAmandemen::select('id')
            ->where('sp_induk_id', $spIndukId)
            ->orderBy('id','desc')
            ->first()
            ->getAttribute('id');

        $spStatus = SpInduk::select('status')
            ->where('id', $spIndukId)
            ->first()
            ->getAttribute('status');
        
        if(
            $spStatus > 0 && 
            $spStatus < 3 && 
            $id==$idCek
        ){
            $return = true;
        }
       
        return $return;
    }

    public function sp_induks():BelongsTo
    {
        return $this->belongsTo(SpInduk::class, 'sp_induk_id','id');
    }
    public function master_units():BelongsTo
    {
        return $this->belongsTo(MasterUnit::class, 'master_unit_id','id');
    }
    public function khs_amandemens():BelongsTo
    {
        return $this->belongsTo(KhsAmandemen::class, 'khs_amandemen_id','id');
    }
}
