<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->string('farm_item');
            $table->decimal('quantity', 10, 2);
            $table->string('unit');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('operation_price', 12, 2);
            $table->string('status')->default('draft'); // draft, approved, in_progress, completed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}; 