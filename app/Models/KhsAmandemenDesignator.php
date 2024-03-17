<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhsAmandemenDesignator extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function khs_amandemens():BelongsTo
    {
        return $this->belongsTo(KhsAmandemen::class, 'khs_amandemen_id', 'id');
    }

}
