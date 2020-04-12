<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('location_id')->nullable(false);
            $table->unsignedBigInteger('shipment_id')->nullable(false);
            $table->boolean('completed')->default(false);
            $table->enum('type', ['delivery', 'receipt']);

            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('location_id')
                ->references('id')
                ->on('location')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('shipment_id')
                ->references('id')
                ->on('shipment')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign([
                'user_id',
                'location_id',
                'shipment_id'
            ]);
        });
        Schema::dropIfExists('task');
    }
}
