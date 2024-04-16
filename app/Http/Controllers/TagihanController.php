<?php

namespace App\Http\Controllers;

use App\Models\KhsAmandemen;
use App\Models\Lov;
use App\Models\SpAmandemen;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class TagihanController extends Controller
{
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Data Tagihan";
        return view('mods.tagihan.index', compact('data'));
    }

    public function indexUser()
    {
        $data['page'] = 'index-user';
        $data['title'] = "Data Tagihan";
        return view('mods.tagihan.index', compact('data'));
    }

    public function indexPro()
    {
        $data['page'] = 'index-pro';
        $data['title'] = "Data Tagihan";
        return view('mods.tagihan.index', compact('data'));
    }

    public function create($spId)
    {
        $data['page'] = 'create';
        $data['title'] = "Buat Tagihan Baru";
        $data['key'] = $spId;
        return view('mods.tagihan.index', compact('data'));
    }

    public function edit($tagihanId)
    {
        $data['page'] = 'edit';
        $data['title'] = "Edit Data Tagihan";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function invoice($tagihanId)
    {
        $data['page'] = 'invoice';
        $data['title'] = "Tagihan Tahap 2";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function invoiceRevisi($tagihanId)
    {
        $data['page'] = 'invoice-revisi';
        $data['title'] = "Revisi Tagihan Tahap 2";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function revisi($tagihanId)
    {
        $data['page'] = 'revisi';
        $data['title'] = "Revisi Data Tagihan";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function prosesUser($tagihanId)
    {
        $data['page'] = 'proses-user';
        $data['title'] = "Proses Data Tagihan";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function prosesPro($tagihanId)
    {
        $data['page'] = 'proses-pro';
        $data['title'] = "Proses Data Tagihan";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }
    public function proses2Pro($tagihanId)
    {
        $data['page'] = 'proses2-pro';
        $data['title'] = "Proses Data Tagihan Tahap 2";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }

    public function detail($tagihanId)
    {
        $data['page'] = 'detail';
        $data['title'] = "Detail Data Tagihan";
        $data['key'] = $tagihanId;
        return view('mods.tagihan.index', compact('data'));
    }

    public function file($tagihanId, Request $request)
    {

        $listFile = explode(',', $request->file);

        $dtFile = [];
        foreach ($listFile as $key => $value) {
            $dtFile[$key] = Tagihan::dtFileBa($value);
        }

        $dt['file'] = $dtFile;

        $dt['tagihan'] = Tagihan::find($tagihanId)->toArray();
        unset(
            // $dt['tagihan']['created_at'],
            $dt['tagihan']['updated_at'],
            $dt['tagihan']['deleted_at'],
            $dt['tagihan']['status_label'],
            $dt['tagihan']['status_desc'],
        );
        $dt['tagihan']['json'] = json_decode($dt['tagihan']['json'],true);
        $dt['dt_tagihan'] = $dt['tagihan']['json']['dt_tagihan'];
        $dt['dt_sp'] = $dt['tagihan']['json']['dt_sp'];

        $dt['aman_khs'] = KhsAmandemen::where('khs_induk_id', $dt['dt_sp']['khs_induk_id'])
            ->get()
            ->toArray();
        if(count($dt['aman_khs']) > 0){
            $dt['aman_khs']['json'] = json_decode($dt['aman_khs']['json'], true);
        }

        $dt['aman_sp'] = SpAmandemen::where('sp_induk_id', $dt['dt_sp']['id'])
            ->get()
            ->toArray();
        if(count($dt['aman_sp']) > 0){
            $dt['aman_sp']['json'] = json_decode($dt['aman_sp']['json'], true);
        }
        // dd($dt);
        return view('mods.ba.index', compact('dt'));
    }

    public function dtMitra()
    {
        $data = Tagihan::select(
            "tagihans.*",
            DB::raw("DATE_FORMAT(tagihans.created_at, '%d/%m/%Y') as created_at_format"),
            DB::raw("DATE_FORMAT(tagihans.updated_at, '%d/%m/%Y') as updated_at_format"),

            )
            ->orderBy('tagihans.created_at', 'desc')
            ->where('tagihans.mitra_id', Auth::id())
            ->with([
                'sp_induks.khs_induks',
                'mitras.master_users'
            ])
            
        ;

        // dd($data->get()->toArray());

        return DataTables::of($data)
            ->addColumn('action', function($data){
                $return = '
                <div class="btn-group">
                    <a href="javascript:void(0)" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu" style="">
                ';

                if($data->status >= 8){
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#fileBaModal"><i class="far fa-file fa-fw"></i> Lihat File BA</a>
                    ';
                }

                if($data->status < 12){

                    if($data->status == 10 || $data->status==11){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.invoiceRevisi', $data->id).'"><i class="far fas fa-file-invoice fa-fw"></i> Revisi Tagihan Tahap 2</a>
                        ';
                    }
                    if($data->status == 8){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.invoice', $data->id).'"><i class="far fas fa-file-invoice fa-fw"></i> Lanjut Tagihan Tahap 2</a>
                        ';
                    }
                    if($data->status == 1){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.create', $data->sp_induk_id).'"><i class="far ri-reply-line fa-fw"></i> Ajukan Ulang</a>
                        ';
                    }
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
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
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    } 

    public function dtUser()
    {
        $data = Tagihan::select(
            "tagihans.*",
            DB::raw("DATE_FORMAT(tagihans.created_at, '%d/%m/%Y') as created_at_format"),
            DB::raw("DATE_FORMAT(tagihans.updated_at, '%d/%m/%Y') as updated_at_format"),

            )
            ->orderBy('tagihans.created_at', 'desc')
            ->whereHas('sp_induks', function(Builder $q){
                $q->where('master_unit_id', Auth::user()->master_users->master_unit_id);
            })
            ->with([
                'sp_induks.khs_induks'
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

                if($data->status < 99){

                    if(
                        $data->status == 2 ||
                        $data->status == 3 ||
                        $data->status == 4 
                    ){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.prosesUser', $data->id).'"><i class="fas fa-pen-alt fa-fw"></i> Proses</a>
                        ';
                    }

                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
                    ';

                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';

                }else{
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
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
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->json, true);
                return $detail;
            })
            ->rawColumns(['action','status_label'])
            ->toJson();
    }

    public function dtPro()
    {
        $data = Tagihan::select(
            "tagihans.*",
            DB::raw("DATE_FORMAT(tagihans.created_at, '%d/%m/%Y') as created_at_format"),
            DB::raw("DATE_FORMAT(tagihans.updated_at, '%d/%m/%Y') as updated_at_format"),

            )
            ->orderBy('tagihans.created_at', 'desc')
            ->where('tagihans.auth_login_id', Auth::id())
            ->with([
                'sp_induks.khs_induks',
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

                if($data->status >= 8){
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#fileBaModal"><i class="far fa-file fa-fw"></i> Lihat File BA</a>
                    ';
                }

                if($data->status < 99){

                    if(
                        $data->status == 9 ||
                        $data->status == 10 ||
                        $data->status == 11 
                    ){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.proses2Pro', $data->id).'"><i class="fas fa-pen-alt fa-fw"></i> Proses</a>
                        ';
                    }
                    if(
                        $data->status == 5 ||
                        $data->status == 6 ||
                        $data->status == 7 
                    ){
                        $return .= '
                            <a class="dropdown-item" href="'.route('tagihan.prosesPro', $data->id).'"><i class="fas fa-pen-alt fa-fw"></i> Proses</a>
                        ';
                    }

                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
                    ';

                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';

                }else{
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> Detail Tagihan</a>
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
            ->addColumn('json_format', function($data){
                $detail = json_decode($data->json, true);
                return $detail;
            })
            
            ->rawColumns(['action','status_label'])
            ->toJson();
    }
}
