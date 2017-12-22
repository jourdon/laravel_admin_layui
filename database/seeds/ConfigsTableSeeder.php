<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config['name']='J-admin';
        $config['url']='http:://localhost';

        //将数据集合转换为数组，并插入到数据中
        \App\Models\Config::insert($config);
    }
}
