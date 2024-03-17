<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function designator($id, $type, Request $request)
    {
        dd($request->all());
        $data = SpInduk::select(
            "sp_induks.*",
            DB::raw("DATE_FORMAT(tgl_sp, '%d/%m/%Y') as tgl_sp_format"),
            DB::raw("DATE_FORMAT(tgl_toc, '%d/%m/%Y') as tgl_toc_format"),

            )
        ->where('auth_login_id', Auth::id())
        ->withCount('sp_amandemens')
        ->with([
            'khs_induks',
            'auth_logins.master_users',
            'mitras.master_users'
        ])
        ;

        return DataTables::of($data)
            ->addColumn('action', function($data){
                $return = '
                <div class="btn-group">
                    <a href="javascript:void(0)" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu" style="">
                ';

                
                $return .= '
                    <a class="dropdown-item" href="'.route('sp.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                ';


                $return .= '
                    <a class="dropdown-item" href="'.asset(str_replace('public/','storage/',json_decode($data->json,true)['file_sp'])).'" target="_blank"><i class="fas fa-file-pdf fa-fw"></i> Lihat File SP</a>
                ';

                if($data->status < 3){

                    $return .= '
                        <a class="dropdown-item" href="'.route('sp.amanCreate', $data->id).'"><i class="fas fa-file-signature fa-fw"></i> Buat Amandemen '.($data->sp_amandemens_count + 1).'</a>
                    ';
    
                    $return .= '
                        <a class="dropdown-item" href="'.route('sp.edit', $data->id).'"><i class="far fa-edit fa-fw"></i> Edit</a>
                    ';
    
    
                    if($data->status != 0){
                        unset($dtJson);
                        $dtJson['msg'] = 'membatalkan data SP '.$data->no_sp;
                        $dtJson['attr'] = $data->no_sp;
                        $dtJson['id'] = $data->id;
                        $dtJson['callback'] = "disablesp-disable";
                        $dtJson = json_encode($dtJson);
                        $return .= '
                            <a class="dropdown-item" data-emit="modalpassword-prepare" data-toggle="modal" data-target="#modalPassword" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-times fa-fw"></i> Batalkan</a>
                        ';
                    }

                }

                if($data->status == 1){

                    $return .= '<div class="dropdown-divider"></div>';
    
                    unset($dtJson);
                    $dtJson['msg'] = 'menghapus data SP '.$data->no_sp;
                    $dtJson['attr'] = $data->no_sp;
                    $dtJson['id'] = $data->id;
                    $dtJson['callback'] = "deletesp-delete";
                    $dtJson = json_encode($dtJson);
                    $return .= '
                        <a class="dropdown-item text-danger" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                    ';
                }


                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    } 
}
