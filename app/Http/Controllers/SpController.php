<?php

namespace App\Http\Controllers;

use App\Models\SpInduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class SpController extends Controller
{
    public function create()
    {
        $data['page'] = 'create';
        $data['title'] = "Form SP Baru";
        return view('mods.sp.index', compact('data'));
    }
    public function amanCreate($spId)
    {
        if(SpInduk::allowCreateAman($spId)){
            $data['page'] = 'aman-create';
            $data['title'] = "Form Amandemen SP Baru";
            $data['key'] = $spId;
            return view('mods.sp.index', compact('data'));
        }
        return redirect()->route('sp.index');
    }
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Data Surat Pesanan";
        return view('mods.sp.index', compact('data'));
    }
    public function indexMitra()
    {
        $data['page'] = 'index-mitra';
        $data['title'] = "Data Surat Pesanan";
        return view('mods.sp.index', compact('data'));
    }
    public function edit($editId)
    {
        if(SpInduk::allowEdit($editId)){
            $data['page'] = 'edit';
            $data['title'] = "Edit Surat Pesanan";
            $data['key'] = $editId;
            return view('mods.sp.index', compact('data'));
        }else{
            return redirect()->route('sp.index');
        }
    }
    public function detail($spId)
    {
        $data['page'] = 'detail';
        $data['title'] = "Detail Surat Pesanan";
        $data['key'] = $spId;
        return view('mods.sp.index', compact('data'));
    }

    public function dt()
    {
        $data = SpInduk::select(
            "sp_induks.*",
            DB::raw("DATE_FORMAT(tgl_sp, '%d/%m/%Y') as tgl_sp_format"),
            DB::raw("DATE_FORMAT(tgl_toc, '%d/%m/%Y') as tgl_toc_format"),

            )
        ->where('sp_induks.auth_login_id', Auth::id())
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
                    <div class="dropdown-menu">
                ';

                
                $return .= '
                    <a class="dropdown-item" href="'.route('sp.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                ';


                $return .= '
                    <a class="dropdown-item" href="'.asset($data->file_sp).'" target="_blank"><i class="fas fa-file-pdf fa-fw"></i> Lihat File SP</a>
                ';

                
                if(SpInduk::allowCreateAman($data->id)){
                    $return .= '
                        <a class="dropdown-item" href="'.route('sp.amanCreate', $data->id).'"><i class="fas fa-file-signature fa-fw"></i> Buat Amandemen '.($data->sp_amandemens_count + 1).'</a>
                    ';
                }

                if(SpInduk::allowEdit($data->id)){
                    $return .= '
                        <a class="dropdown-item" href="'.route('sp.edit', $data->id).'"><i class="far fa-edit fa-fw"></i> Edit SP Induk</a>
                    ';
                }

                if(SpInduk::allowDelete($data->id)){
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
                $detail = json_decode($data->original_json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    } 

    public function dtMitra()
    {
        $data = SpInduk::select(
            "sp_induks.*",
            DB::raw("DATE_FORMAT(tgl_sp, '%d/%m/%Y') as tgl_sp_format"),
            DB::raw("DATE_FORMAT(tgl_toc, '%d/%m/%Y') as tgl_toc_format"),

            )
            ->orderBy('tgl_sp', 'desc')
            ->where('mitra_id', Auth::id())
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
                    <a class="dropdown-item" href="'.route('sp.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail SP</a>
                ';

                if($data->status == 1){
                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.create', $data->id).'"><i class="fas fa-pencil-alt fa-fw"></i> Buat Tagihan</a>
                    ';
                }

                
                $return .= '
                    <a class="dropdown-item" href="'.asset($data->file_sp).'" target="_blank"><i class="fas fa-file-pdf fa-fw"></i> Lihat File SP</a>
                ';

                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->original_json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    } 
}
