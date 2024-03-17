<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterUser extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function auth_logins():BelongsTo
    {
        return $this->belongsTo(AuthLogin::class, 'auth_login_id', 'id');
    }

    public function auth_roles():BelongsTo
    {
        return $this->belongsTo(AuthRole::class, 'auth_role_id', 'id');
    }

    public function master_units():BelongsTo
    {
        return $this->belongsTo(MasterUnit::class, 'master_unit_id', 'id');
    }
}
