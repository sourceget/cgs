<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\AdminPassword;

class AdminDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $user   = Admin::create([
            'email' => 'mr.sk@qq.com',
            'name'  => '陈德华'
        ]);
        
        $pass   = new AdminPassword();
        $pass->admin_id = $user->id;
        $pass->content  = Hash::make('123456');
        $pass->save();
    }

}
