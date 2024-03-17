<?php

namespace App\Console\Commands;

use App\Models\AuthLogin;
use App\Models\AuthProfile;
use App\Models\MasterMitra;
use App\Models\MasterUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SeederCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seeder';

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
        $dt = [
            [
                'username'=>'procurement', 
                'password'=>Hash::make('rahasia'), 
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'username'=>'konstruksi', 
                'password'=>Hash::make('rahasia'), 
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'username'=>'maintenance', 
                'password'=>Hash::make('rahasia'), 
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'username'=>'mitra', 
                'password'=>Hash::make('rahasia'), 
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
        ];
        foreach ($dt as $key => $value) {
            $value['id'] = $key+2;
            $value['created_at'] = Carbon::now();
            $value['updated_at'] = Carbon::now();
            AuthLogin::insertOrIgnore($value);
        }
        unset($dt);

        $dt = [
            [
                'auth_login_id'=>2, 
                'auth_role_id'=>2, 
                'master_unit_id'=>4, 
                'nama'=>'Procurement',
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'auth_login_id'=>3, 
                'auth_role_id'=>3, 
                'master_unit_id'=>2, 
                'nama'=>'User Satu',
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'auth_login_id'=>4, 
                'auth_role_id'=>3, 
                'master_unit_id'=>3, 
                'nama'=>'User Dua',
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
            [
                'auth_login_id'=>5, 
                'auth_role_id'=>4, 
                'master_unit_id'=>1, 
                'nama'=>'Admin Mitra',
                'detail' => json_encode([
                    'perusahaan' => 'PT. Mitra Sejahtera',
                    'direktur' => 'Dr. Taufik Hidayat',
                    'lokasi' => 'Medan',
                    'alamat' => 'Jl. Mitra No.20, Medan Johor',
                    'telepon' => '1234567890',
                    'email' => 'email@gmail.com',
                ]),
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
        ];
        foreach ($dt as $key => $value) {
            $value['id'] = $key+2;
            $value['created_at'] = Carbon::now();
            $value['updated_at'] = Carbon::now();
            MasterUser::insertOrIgnore($value);
        }
        unset($dt);
    }
}
