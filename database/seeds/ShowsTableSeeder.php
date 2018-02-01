<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0;$i<100;$i++){
            $tmp['sname'] = str_random(10);
            $tmp['cid'] = rand(1,5);
            $tmp['stime'] = date('Y-m-d H:i:s');
            $tmp['vid'] = rand(1,6);
            $tmp['price'] = rand(100,1000);
            $tmp['cnt'] = rand(100,1000);
            $tmp['scnt'] = 0;
            $tmp['vcnt'] = 0;
            $tmp['status'] = rand(1,3);
            $tmp['spic'] = str_random(10);
            $tmp['sdesc'] = str_random(100);
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $data[] = $tmp;
        }

        \DB::table('piao_shows')->insert($data);
    }
}
