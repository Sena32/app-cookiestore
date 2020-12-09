<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('client_id')->unsigned()->index();
            $table->string('product_name');
            $table->decimal('product_price');
            $table->integer('product_amount');
            $table->boolean('status');
            $table->string('notes');
            $table->decimal('value');
            $table->timestamps();
            $table->softDeletes('deleted_at');

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');


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
