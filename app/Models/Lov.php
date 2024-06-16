<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function checkToc($data)
    {
        $return = [];

        $qSetting = Lov::select('value')
            ->where('key','setting')
            ->first()
            ->getAttribute('value');

        $daysInterval = collect($qSetting)->where('key','toc')->first()['value'];
        $tglToc = Carbon::parse($data->tgl_toc);
        $now = Carbon::now();

        if($now->greaterThan($tglToc)){
            $return['status'] = 'Lewat dari tanggal ToC';
            $return['class'] = 'danger';
        }

        if($tglToc->greaterThanOrEqualTo($now)){
            $selisih = $now->diffInDays($tglToc);

            if($selisih >= $daysInterval){
                $return['status'] = 'Lebih '.$daysInterval.' hari dari tanggal ToC';
                $return['class'] = 'success';
            }

            if($selisih < $daysInterval){
                $return['status'] = 'Kurang '.$daysInterval.' hari dari tanggal ToC';
                $return['class'] = 'warning';
            }

        }

        return $return;

    }
}
