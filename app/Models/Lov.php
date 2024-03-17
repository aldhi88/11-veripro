<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lov extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    // protected $appends = ['status_label'];

    // public function getStatusLabelAttribute()
    // {
    //     if($this->status == 0){
    //         return "Tidak Aktif";
    //     }else{
    //         return "Aktif";
    //     }
    // }

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, true),
        );
    }
}
