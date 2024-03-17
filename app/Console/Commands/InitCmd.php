<?php

namespace App\Console\Commands;

use App\Models\AuthLogin;
use App\Models\AuthProfile;
use App\Models\AuthRole;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InitCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dt = [
            ['id'=>1,'name'=>'Administrator', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>2,'name'=>'Procurement', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>3,'name'=>'User', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>4,'name'=>'Mitra', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ];

        AuthRole::insertOrIgnore($dt);
        unset($dt);

        $dt = [
            ['id'=>1,'nama'=>'-', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>2,'nama'=>'OSP-FO', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>3,'nama'=>'QE', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['id'=>4,'nama'=>'Shared Service', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ];
        MasterUnit::insertOrIgnore($dt);
        unset($dt);

        $dt = [
            [
                'id'=>1, 
                'username'=>'admin', 
                'password'=>Hash::make('rahasia'), 
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
        ];
        AuthLogin::insertOrIgnore($dt);
        unset($dt);

        $dt = [
            [
                'id'=>1, 
                'auth_login_id'=>1, 
                'auth_role_id'=>1, 
                'master_unit_id'=>1, 
                'nama'=>'Administrator',
                'created_at'=>Carbon::now(), 
                'updated_at'=>Carbon::now()
            ],
        ];
        MasterUser::insertOrIgnore($dt);
        unset($dt);

    
        $this->call('app:lov');
        $this->call('app:seeder');
    }

    
}
