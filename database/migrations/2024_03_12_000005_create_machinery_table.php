<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('machineries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->enum('status', ['operational', 'maintenance', 'repair', 'retired'])->default('operational');
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->date('purchase_date');
            $table->decimal('purchase_price', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('machineries');
    }
}; 