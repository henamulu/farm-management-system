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
            $table->string('name');
            $table->string('type'); // tipo de stock (semillas, fertilizantes, etc.)
            $table->integer('quantity');
            $table->string('unit'); // unidad de medida
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}; 