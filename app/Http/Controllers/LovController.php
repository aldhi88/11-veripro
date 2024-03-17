<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use DataTables;

class LovController extends Controller
{
    public function index()
    {
        $data['page'] = 'index';
        $data['title'] = "Data Statik";
        return view('mods.lov.index', compact('data'));
    }

    public function dtIndex(){
        $data = Lov::select(
            'id',"key",'value'
        );
        return DataTables::of($data)
            ->addColumn('action', function($data){
                return '
                    <div class="btn-group">
                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item" data-id="'.$data->id.'" href="javascript:void(0);" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                        </div>
                    </div>
                ';
            })
            ->addColumn('value_format_pejabat', function($data){
                $pejabat = "";
                foreach ($data->value['nama'] as $key => $value) {
                    $pejabat .= $value;
                    if($key < count($data->value['nama'])-1){
                        $pejabat .= "</br>";
                    }
                }
                return $pejabat;
            })
            ->addColumn('value_format_jabatan', function($data){
                $jabatan = "";
                foreach ($data->value['jabatan'] as $key => $value) {
                    $jabatan .= $value;
                    if($key < count($data->value['jabatan'])-1){
                        $jabatan .= "</br>";
                    }
                }
                
                return $jabatan;
            })
            ->rawColumns(['action','value_format_pejabat','value_format_jabatan'])
            ->toJson();

    }
}
