<?php

namespace App\Http\Controllers;

use App\Models\KhsAmandemen;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class KhsController extends Controller
{
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Data KHS Induk";
        return view('mods.khs.index', compact('data'));
    }
    public function create()
    {
        $data['page'] = 'create';
        $data['title'] = "Form KHS Induk Baru";
        return view('mods.khs.index', compact('data'));
    }
    public function amanCreate($khsId)
    {
        $data['page'] = 'aman-create';
        $data['title'] = "Form Amandemen KHS";
        $data['key'] = $khsId;
        return view('mods.khs.index', compact('data'));
    }
    public function edit($editId)
    {
        $data['page'] = 'edit';
        $data['title'] = "Edit KHS Induk";
        $data['key'] = $editId;
        return view('mods.khs.index', compact('data'));
    }
    public function editAman($editId)
    {
        $isAllow = KhsAmandemen::isAllowEdit($editId);
        if($isAllow){
            $data['page'] = 'edit-aman';
            $data['title'] = "Edit Amandemen KHS";
            $data['key'] = $editId;
            return view('mods.khs.index', compact('data'));
        }
        return redirect()->route('khs.index');
    }
    public function deleteAman($id)
    {
        $data['page'] = 'delete-aman';
        $data['title'] = "Delete Amandemen KHS";
        $data['key'] = $id;
        return view('mods.khs.index', compact('data'));
    }
    public function detail($khsId)
    {
        $data['page'] = 'detail';
        $data['title'] = "Detail KHS";
        $data['key'] = $khsId;
        return view('mods.khs.index', compact('data'));
    }

    public function dt()
    {
        $data = KhsInduk::select(
                "khs_induks.*",
                DB::raw("DATE_FORMAT(tgl_berlaku, '%d/%m/%Y') as tgl_berlaku_format"),
            )
            ->withCount([
                'khs_amandemens',
                'khs_induk_designators',
                'sp_induks'
                
            ])
            ->with([
                'auth_logins.master_users',
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
                    <a class="dropdown-item" href="'.route('khs.amanCreate', $data->id).'"><i class="fas fa-file-signature fa-fw"></i> Buat Amandemen</a>
                ';
                $return .= '
                    <a class="dropdown-item" href="'.route('khs.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                ';

                if(KhsInduk::isAllowEdit($data->id)){
                    $return .= '
                        <a class="dropdown-item" href="'.route('khs.edit', $data->id).'"><i class="far fa-edit fa-fw"></i> Edit</a>
                    ';
                }
                
                $return .= '<div class="dropdown-divider"></div>';


                if(KhsInduk::isAllowDelete($data->id)){
                    unset($dtJson);
                    $dtJson['msg'] = 'menghapus data KHS '.$data->no_kontrak;
                    $dtJson['attr'] = $data->no_kontrak;
                    $dtJson['id'] = $data->id;
                    $dtJson['callback'] = "deletekhs-delete";
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
            ->addColumn('master_users_detail_json', function($data){
                return json_decode($data->auth_logins->master_users->detail, true);
            })
            ->rawColumns(['action'])
            ->toJson();
    } 

    public function detailKhsIndukDt(Request $request)
    {
        // dd($request->all());
        $data = KhsIndukDesignator::query()
            ->where('khs_induk_id', $request->dataId);

        return DataTables::of($data)
            ->addColumn('fix_price', function($data){
                $status = 'checked';
                if(!$data->fix_price){
                    $status = '';
                }
                $return = '
                    <input key="'.$data->id.'" 
                        value="'.$data->fix_price.'" 
                        id="'.preg_replace('/[0-9]+/', '', md5(rand())).'" table="induk" 
                        type="checkbox" '.$status.'>
                ';

                return $return;
            })
            ->rawColumns(['fix_price'])
            ->addIndexColumn()
            ->toJson();
    }

    public function detailKhsAmanDt(Request $request)
    {
        // dd($request->all());
        $data = KhsAmandemenDesignator::query()
            ->where('khs_amandemen_id', $request->dataId);

        return DataTables::of($data)
            ->addColumn('fix_price', function($data){
                $status = 'checked';
                if(!$data->fix_price){
                    $status = '';
                }
                $return = '
                    <input key="'.$data->id.'" 
                        value="'.$data->fix_price.'" 
                        id="'.preg_replace('/[0-9]+/', '', md5(rand())).'" table="aman" 
                        type="checkbox" '.$status.'>
                ';

                return $return;
            })
            ->rawColumns(['fix_price'])
            ->addIndexColumn()
            ->toJson();
    }
}
