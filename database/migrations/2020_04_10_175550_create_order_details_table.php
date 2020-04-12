<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 255)->nullable(false);
            $table->unsignedBigInteger('shipment_id')->nullable(false);
            $table->unsignedBigInteger('from_id')->nullable(false);
            $table->unsignedBigInteger('to_id')->nullable(false);

            $table->foreign('order_id')
                ->references('id')
                ->on('order')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('shipment_id')
                ->references('id')
                ->on('shipment')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('from_id')
                ->references('id')
                ->on('location')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('to_id')
                ->references('id')
                ->on('location')
                ->onDelete('restrict')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign([
                'order_id',
                'shipment_id',
                'from_id',
                'to_id'
            ]);
        });
        Schema::dropIfExists('order_details');
    }
}
