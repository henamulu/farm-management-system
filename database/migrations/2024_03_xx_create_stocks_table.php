<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('category');
            $table->decimal('quantity', 10, 2);
            $table->string('unit');
            $table->decimal('minimum_threshold', 10, 2);
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}; 