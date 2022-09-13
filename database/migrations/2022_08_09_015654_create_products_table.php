<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('cost_price', 14, 4);
            $table->decimal('selling_price', 14, 4);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('quantity', 14, 4)->default(1);
            $table->string('picture')->nullable();
            $table->boolean('status')->default(true);

            $table->foreignId('category_id')->nullable()->constrained('categories')->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->nullOnDelete();


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
        Schema::dropIfExists('products');
    }
}
