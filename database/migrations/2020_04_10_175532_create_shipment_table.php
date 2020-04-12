<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('received_location_id')->nullable(false);
            $table->unsignedBigInteger('issued_location_id')->nullable(false);
            $table->unsignedFloat('amount')->default(0);
            $table->enum('status', ['delivered', 'received', 'created'])->default('created');

            $table->foreign('received_location_id')
                ->references('id')
                ->on('location')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('issued_location_id')
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
        Schema::table('shipment', function (Blueprint $table) {
            $table->dropForeign([
                'received_location_id',
                'issued_location_id'
            ]);
        });
        Schema::dropIfExists('shipment');
    }
}
