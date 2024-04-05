<?php

namespace App\Console\Commands;

use App\Models\Lov;
use Illuminate\Console\Command;

class LovCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:lov';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Lov::query()->forceDelete();


        $gmTa = [
            'nama' => [
                'Imanuel Ginting S',
            ],
            'jabatan' => [
                'GM TA Medan',
                'GM Area Medan',
            ]
        ];
        $mgrKonstruksi = [
            'nama' => [
                'Imanuel Ginting S. ',
                'Maikel Joy',
                'Iswandi Siregar',
            ],
            'jabatan' => [
                'PGS Mgr Construction Medan',
                'Mgr. Konstruksi Medan',
            ]
        ];
        $smKonstruksi = [
            'nama' => [
                'Budiman Tanjung',
                'Sefgi Fandi Habibi',
            ],
            'jabatan' => [
                'Site Manager Project Deployment',
            ]
        ];
        $mgrMaintenance = [
            'nama' => [
                'Aulia Rahmat Kris Fadlin Siregar',
                'Hafitra Hariansyah',
                'Yogi SM',
            ],
            'jabatan' => [
                'Mgr. Assurance & Maintenance Medan',
                'Mgr. Wilayah Medan',
            ]
        ];
        $smMaintenance = [
            'nama' => [
                'Harun Parinduri',
                'Heri Purwanto',
            ],
            'jabatan' => [
                'Site Manager Corrective Maintenance',
            ]
        ];
        $mgrShared = [
            'nama' => [
                'Imanuel Ginting S',
                'FX. Sigit Eko Prayogo',
                'Rea Timotitus Zebua',
            ],
            'jabatan' => [
                'Mgr. Shared Service Medan',
            ]
        ];
        $waspang = [
            'nama' => [
                'Eggy Herwan Syah Putra',
                'Erwinsyah Pasaribu',
                'Supriatna',
                'William Frans Sianipar',
                'Yopie Lahardo Soselisa',
                'Harya Admaja'
            ],
            'jabatan' => [
                'Waspang',
            ]
        ];
        $gudang = [
            'nama' => [
                'Jeplyn Sahat Martumbar Siboro',
            ],
            'jabatan' => [
                'Petugas Gudang',
            ]
        ];
        $data = [
            ['key'=>'gm_ta','value'=>json_encode($gmTa)],
            ['key'=>'mgr_osp-fo','value'=>json_encode($mgrKonstruksi)],
            ['key'=>'sm_osp-fo','value'=>json_encode($smKonstruksi)],
            ['key'=>'mgr_qe','value'=>json_encode($mgrMaintenance)],
            ['key'=>'sm_qe','value'=>json_encode($smMaintenance)],
            ['key'=>'mgr_shared','value'=>json_encode($mgrShared)],
            ['key'=>'waspang','value'=>json_encode($waspang)],
            ['key'=>'gudang','value'=>json_encode($gudang)],
            
        ];
        foreach ($data as $key => $value) {
            $value['id'] = $key+1;
            Lov::create($value);
        }
        echo "Master Lov data has been generated\n";
        unset($data);
    }
}
