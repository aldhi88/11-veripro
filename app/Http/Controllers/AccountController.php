<?php

namespace App\Http\Controllers;

use App\Models\AuthLogin;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Data Akun Karyawan";
        return view('mods.account.index', compact('data'));
    }
    public function create()
    {
        $data['page'] = 'create';
        $data['title'] = "Form Akun Baru";
        return view('mods.account.index', compact('data'));
    }
    public function myAccount()
    {
        $data['page'] = 'my-account';
        $data['title'] = "Data Akun Saya";
        return view('mods.account.index', compact('data'));
    }
    public function edit($key)
    {
        $data['page'] = 'edit';
        $data['title'] = "Edit Data Akun";
        $data['key'] = $key;
        return view('mods.account.index', compact('data'));
    }
    public function mitra()
    {
        $data['page'] = 'mitra';
        $data['title'] = "Data Mitra";
        return view('mods.account.index', compact('data'));
    }
    public function changePassMitra($key)
    {
        $data['page'] = 'change-pass-mitra';
        $data['title'] = "Reset Sandi Login Mitra";
        $data['key'] = $key;
        return view('mods.account.index', compact('data'));
    }
    public function mitraPending()
    {
        $data['page'] = 'mitra-pending';
        $data['title'] = "Persetujuan Akun Mitra";
        return view('mods.account.index', compact('data'));
    }
    

    public function dt()
    {
        $data = AuthLogin::query()
            ->select(
                "auth_logins.*",
                DB::raw("DATE_FORMAT(auth_logins.created_at, '%d/%m/%Y') as created_at_id"),
            )
            ->with([
                'master_users.auth_roles',
                'master_users.master_units',
            ])
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', '!=', 4);
            })
            ->where('auth_logins.id', '!=', Auth::user()->id)

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
                    <a class="dropdown-item" href="'.route('account.edit', $data->id).'"><i class="far fa-edit"></i> Edit</a>
                ';

                $dtJson['msg'] = 'menghapus akun '.$data->username;
                $dtJson['attr'] = $data->username;
                $dtJson['id'] = $data->id;
                $dtJson['callback'] = "deleteaccount-delete";
                $dtJson = json_encode($dtJson);
                $return .= '
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-trash-alt"></i> Hapus</a>
                ';

                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function mitraDt()
    {
        $data = AuthLogin::query()
            ->select(
                "auth_logins.*",
                DB::raw("DATE_FORMAT(auth_logins.created_at, '%d/%m/%Y') as created_at_id"),
            )
            ->with([
                'master_users.auth_roles',
                'master_users.master_units',
            ])
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', 4);
            })
            ->where('status', 1)
            ->where('auth_logins.id', '!=', Auth::user()->id)
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
                    <a class="dropdown-item" href="'.route('account.changePassMitra', $data->id).'"><i class="far fa-edit"></i> Edit</a>
                ';

                // unset($dtJson);
                // $dtJson['msg'] = 'menghapus akun mitra '.$data->username;
                // $dtJson['attr'] = $data->username;
                // $dtJson['id'] = $data->id;
                // $dtJson['callback'] = "deletemitra-delete";
                // $dtJson = json_encode($dtJson);
                // $return .= '
                //     <div class="dropdown-divider"></div>
                //     <a class="dropdown-item text-danger" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-trash-alt"></i> Hapus</a>
                // ';

                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->addColumn('detail_json', function($data){
                $detail = json_decode($data->master_users->detail, true);
                return $detail;
                // return $detail['perusahaan'];
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function mitraPendingDt()
    {
        $data = AuthLogin::query()
            ->select(
                "auth_logins.*",
                DB::raw("DATE_FORMAT(auth_logins.created_at, '%d/%m/%Y') as created_at_id"),
            )
            ->with([
                'master_users.auth_roles',
                'master_users.master_units',
            ])
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', 4);
            })
            ->where('status', 0)
            ->where('auth_logins.id', '!=', Auth::user()->id)
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

                // $return .= '
                //     <a class="dropdown-item" href="'.route('account.edit', $data->id).'"><i class="fas fa-user-check"></i> Setujui</a>
                // ';

                unset($dtJson);
                $dtJson['msg'] = 'menyetujui akun '.$data->username;
                $dtJson['attr'] = $data->username;
                $dtJson['id'] = $data->id;
                $dtJson['callback'] = "approvemitra-approve";
                $dtJson = json_encode($dtJson);
                $return .= '
                    <a class="dropdown-item" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-user-check"></i> Setujui</a>
                ';

                unset($dtJson);
                $dtJson['msg'] = 'menghapus akun pending '.$data->username;
                $dtJson['attr'] = $data->username;
                $dtJson['id'] = $data->id;
                $dtJson['callback'] = "deletemitra-delete";
                $dtJson = json_encode($dtJson);
                $return .= '
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json=\''.$dtJson.'\'><i class="fas fa-trash-alt"></i> Hapus</a>
                ';

                $return .='
                    </div>
                </div>
                ';

                return $return;
            })
            ->addColumn('detail_json', function($data){
                $detail = json_decode($data->master_users->detail, true);
                return $detail;
                // return $detail['perusahaan'];
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
