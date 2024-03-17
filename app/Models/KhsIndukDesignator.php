<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhsIndukDesignator extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function khs_induks():BelongsTo
    {
        return $this->belongsTo(KhsInduk::class, 'khs_induk_id', 'id');
    }
}
