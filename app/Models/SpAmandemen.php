<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpAmandemen extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function sp_induks():BelongsTo
    {
        return $this->belongsTo(SpInduk::class, 'sp_induk_id','id');
    }
    public function khs_induks():BelongsTo
    {
        return $this->belongsTo(KhsInduk::class, 'khs_induk_id','id');
    }
    public function khs_amandemens():BelongsTo
    {
        return $this->belongsTo(KhsAmandemen::class, 'khs_amandemen_id','id');
    }
}
