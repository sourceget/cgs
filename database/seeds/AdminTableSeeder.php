<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin')->delete();
        
        \DB::table('admin')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '陈德华',
                'email' => 'mr.sk@qq.com',
                'remember_token' => 'ZmSigzfQ1p2YZawm4jEN7ISRJAreXbrof1rz3y6o7IaTLXo4zT1GWCUJTBps',
                'created_at' => '2016-05-30 15:12:57',
                'updated_at' => '2016-05-30 15:26:02',
            ),
        ));
        
        
    }
}
