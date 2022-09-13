<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();

            $table->decimal('quantity', 14, 4)->default(1);
            $table->decimal('price', 14, 4)->default(1);

            $table->foreignId('order_id')->nullable()->constrained('orders')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('product_id')->nullable()->constrained('products')->onUpdate('cascade')->nullOnDelete();


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
        Schema::dropIfExists('order_products');
    }
}
