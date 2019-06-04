<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('start_latitude', 10, 6);
            $table->decimal('start_longitude', 10, 6);
            $table->decimal('end_latitude', 10, 6);
            $table->decimal('end_longitude', 10, 6);
            $table->integer('distance');
            $table->enum('status', array('UNASSIGN', 'SUCCESS'));
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
