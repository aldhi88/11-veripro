<?php

namespace App\Http\Controllers;

use App\Models\KhsAmandemen;
use App\Models\Lov;
use App\Models\SpAmandemen;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



class TagihanController extends Controller
{
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

        $dt['aman_khs'] = (KhsAmandemen::where('khs_induk_id', $dt['dt_sp']['khs_induk_id'])
            ->get())
            ->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    unset(
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                    );

                    return $item;
                }
            )
            ->toArray();

        $dt['aman_sp'] = (SpAmandemen::where('sp_induk_id', $dt['dt_sp']['id'])
            ->get())
            ->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    unset(
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                    );

                    return $item;
                }
            )
            ->toArray();

        $allDesigs = [];
        foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $i => $v) {
            foreach ($v['desig_items'] as $i2 => $v2) {
                $allDesigs[] = $v2;
            }
        }

        // dd($allDesigs);

        $grouped = collect($allDesigs)->groupBy(function($item) {
            return $item['nama_material'] . '|' . $item['nama_jasa'] . '|' . $item['nama_designator'];
        });

        $dtDesig = $grouped->map(function($items) {

            // logic agar hrg yg 0 jadi -
            $hrg_material = $items->first()['material'];
            $hrg_jasa = $items->first()['jasa'];

            $vol_tambah = $items->sum('volume_tambah');
            $vol_kurang = $items->sum('volume_kurang');
            if($vol_tambah>0 && $vol_kurang>0){
                $selisih = $vol_tambah - $vol_kurang;
                $vol_tambah = $selisih;
                $vol_kurang = 0;
                if($selisih < 0){
                    $vol_tambah = 0;
                    $vol_kurang = ($selisih*(-1));
                }
            }

            $total_material_tambah = $items->sum('total_material_tambah');
            $total_material_kurang = $items->sum('total_material_kurang');
            if($total_material_tambah>0 && $total_material_kurang>0){
                $selisih = $total_material_tambah - $total_material_kurang;
                $total_material_tambah = $selisih;
                $total_material_kurang = 0;
                if($selisih < 0){
                    $total_material_tambah = 0;
                    $total_material_kurang = ($selisih*(-1));
                }
            }

            $total_jasa_tambah = $items->sum('total_jasa_tambah');
            $total_jasa_kurang = $items->sum('total_jasa_kurang');
            if($total_jasa_tambah>0 && $total_jasa_kurang>0){
                $selisih = $total_jasa_tambah - $total_jasa_kurang;
                $total_jasa_tambah = $selisih;
                $total_jasa_kurang = 0;
                if($selisih < 0){
                    $total_jasa_tambah = 0;
                    $total_jasa_kurang = ($selisih*(-1));
                }
            }


            return [
                "nama_material" => $items->first()['nama_material'],
                "nama_jasa" => $items->first()['nama_jasa'],
                "nama_designator" => $items->first()['nama_designator'],
                "uraian" => $items->first()['uraian'],
                "satuan" => $items->first()['satuan'],
                "hrg_material" => $hrg_material,
                "hrg_jasa" => $hrg_jasa,
                "vol_sp" => $items->sum('vol'),
                "vol_rekon" => $items->sum('volume_rekon'),
                "vol_tambah" => $vol_tambah,
                "vol_kurang" => $vol_kurang,
                "total_material_sp" => $items->sum('total_material'),
                "total_jasa_sp" => $items->sum('total_jasa'),
                "total_material_rekon" => $items->sum('total_material_rekon'),
                "total_jasa_rekon" => $items->sum('total_jasa_rekon'),
                "total_material_tambah" => $total_material_tambah,
                "total_jasa_tambah" => $total_jasa_tambah,
                "total_material_kurang" => $total_material_kurang,
                "total_jasa_kurang" => $total_jasa_kurang,
            ];
        })->values()->toArray();

        // dd($dt, $dtDesig);
        Carbon::setLocale('id');
        $doc = Tagihan::dtDokTurnkey();
        
        return view('mods.ba.index', compact('dt','dtDesig', 'doc'));
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
                    ';

                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';

                }else{
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
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
            // ->orderBy('tagihans.created_at', 'desc')
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
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
                    ';

                    $return .= '
                        <a class="dropdown-item" href="'.route('tagihan.detail', $data->id).'"><i class="fas fa-align-justify fa-fw"></i> Detail</a>
                    ';

                }else{
                    $return .= '
                        <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#historyModal"><i class="fas fa-history fa-fw"></i> History Tagihan</a>
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
            ->addColumn('toc_format', function($data){
                $tocStatus = Lov::checkToc($data->sp_induks);
                return '<h5 style="cursor: pointer" title="'.$tocStatus['status'].'" class="mb-0">
                    <span class="badge w-100 badge-'.$tocStatus['class'].'">'.Carbon::parse($data->sp_induks->tgl_toc)->format('d/m/Y').'</span>
                </h5>';
            })
            ->rawColumns(['action','status_label','toc_format'])
            ->toJson();
    }

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
}
