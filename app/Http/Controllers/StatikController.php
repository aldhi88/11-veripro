<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class StatikController extends Controller
{
    public function index()
    {
        $data['page'] = "index";
        $data['title'] = "Data Statik";

        return view('mods.statik.index', compact('data'));
    }

    public function dt()
    {
        $data = collect([
            ['keyword' => 'alamat_instansi', 'value' => 'Jl. Gaharu, No.1, Medan'],
            ['keyword' => 'gm_ta', 'value' => 'IMANUEL GINTING S'],
        ]);

        return DataTables::of($data)
            ->addColumn('action', function($data){
                return '
                    <div class="btn-group" wire:click="delete(2)">
                        <a href="#" wire:click="delete(2)" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item" data-id="'.$data['keyword'].'" href="javascript:void(0);" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="javascript:void(0);" data-attr="'.$data['keyword'].'" data-id="'.$data['keyword'].'" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
