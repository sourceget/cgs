<?php namespace Modules\Baidu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BaiduDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Model::unguard();

            // $this->call("OthersTableSeeder");
    }

}