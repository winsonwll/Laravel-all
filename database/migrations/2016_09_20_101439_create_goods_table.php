<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id')->comment('商品的主键id');
            $table->string('title')->comment('商品的标题');
            $table->decimal('price',8,2)->comment('商品的价格');
            $table->integer('cnt')->comment('商品的库存');
            $table->string('pic')->comment('商品的主图');
            $table->integer('cid')->comment('商品的分类id');
            $table->text('content')->comment('商品的详情');
            $table->string('color')->comment('商品的颜色');
            $table->string('size')->comment('商品的尺寸');
            $table->tinyInteger('status')->comment('商品的状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
