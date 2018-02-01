<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Goods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[];
        for($i=0; $i<20; $i++){
            $tmp['title'] = str_random(20);
            $tmp['price'] = rand(100,10000);
            $tmp['pic'] = '/uploads/20160917/s_14740957684839.jpg';
            $tmp['cid'] = rand(1,5);
            $tmp['content'] = str_random(200);
            $tmp['cnt'] = rand(1,299);
            $tmp['color'] = '红色,绿色,白色,粉色,紫色';
            $tmp['size'] = '37,38,39,40,41,42,XL,XXL,XXXL,L';
            $tmp['status'] = 1;
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');
            $data[] =$tmp;
        }

        //写入数据库
        \DB::table('goods')->insert($data);
    }
}
