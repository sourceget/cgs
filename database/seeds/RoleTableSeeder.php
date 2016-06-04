<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role')->delete();
        
        \DB::table('role')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '管理员',
                'description' => '所有权限',
                'created_at' => '2016-05-31 00:00:00',
                'updated_at' => '2016-05-31 00:00:00',
            ),
        ));
        
        
    }
}
