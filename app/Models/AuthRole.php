<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthRole extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function auth_logins():HasOne
    {
        return $this->hasOne(AuthLogin::class, 'auth_role_id', 'id');
    }
    
}
