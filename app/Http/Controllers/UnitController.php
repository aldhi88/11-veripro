<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class UnitController extends Controller
{
    public function index()
    {
        $data['page'] = "index";
        $data['title'] = "Pejabat Unit";

        return view('mods.unit.index', compact('data'));
    }

    public function dt()
    {
        $data = collect([
            ['unit' => 'Konstruksi', 'nama' => 'Budi', 'jabatan' => 'Mgr. Konstruksi Medan'],
            ['unit' => 'Maintenance', 'nama' => 'Robi', 'jabatan' => 'Mgr. Assurance & Maintenance Medan'],
        ]);

        return DataTables::of($data)
            ->addColumn('action', function($data){
                return '
                    <div class="btn-group" wire:click="delete(2)">
                        <a href="#" wire:click="delete(2)" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item" data-id="'.$data['unit'].'" href="javascript:void(0);" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="javascript:void(0);" data-attr="'.$data['unit'].'" data-id="'.$data['unit'].'" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
