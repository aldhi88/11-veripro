<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Semua Tagihan Aktif";
        return view('mods.dashboard.index', compact('data'));
    }

    public function dt()
    {
        $data = Tagihan::select(
                "tagihans.*",
                DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as created_at_format"),
                DB::raw("DATE_FORMAT(updated_at, '%d/%m/%Y') as updated_at_format"),
            )
            ->orderBy('created_at', 'desc')
            ->where('status', '<', 12)
            ->with([
                'sp_induks.khs_induks'
            ])
            
        ;

        if(Auth::user()->master_users->auth_role_id == 3){
            $data->whereHas('sp_induks', function(Builder $q){
                $q->where('master_unit_id', Auth::user()->master_users->master_unit_id);
            });
        }elseif (Auth::user()->master_users->auth_role_id == 4) {
            $data->where('mitra_id', Auth::id());
        }

        return DataTables::of($data)
            ->addColumn('action', function($data){
                $return = '
                <div class="btn-group">
                    <a href="javascript:void(0)" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu" style="">
                ';

                if($data->status < 99){

                    if($data->status == 2){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.edit', $data->id).'"><i class="far fa-edit fa-fw"></i> Edit</a>
                        ';
                    }
                    if($data->status == 3 || $data->status == 6){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.revisi', $data->id).'"><i class="fas fa-pen-alt fa-fw"></i> Revisi</a>
                        ';
                    }

                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Status</a>
                    ';

                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';


                    $return .= '<div class="dropdown-divider"></div>';

                    unset($dtJson);
                    $dtJson['msg'] = 'menghapus data Tagihan ';
                    $dtJson['attr'] = '';
                    $dtJson['id'] = $data->id;
                    $dtJson['callback'] = "deletetagihan-delete";
                    $dtJson = json_encode($dtJson);
                    $return .= '
                        <a class="dropdown-item text-danger" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                    ';

                }else{
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Status</a>
                    ';
                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';
                }
                


                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->addColumn('total_sp', function($data){
                $return = json_decode($data->json, true);
                return number_format($return['total_sp'],0,',','.');
            })
            ->addColumn('total_rekon', function($data){
                $return = json_decode($data->json, true);
                return number_format($return['total_rekon'],0,',','.');
            })
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    }
}
