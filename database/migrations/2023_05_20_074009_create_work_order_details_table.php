<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('work_order_id');
            $table->integer('emp_id');
            $table->string('code')->unique();
            $table->dateTime('start_order');
            $table->dateTime('end_order')->nullable();
            $table->string('constraint')->nullable();
            $table->string('solution')->nullable();
            $table->string('note')->nullable();
            $table->integer('active')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_order_details');
    }
};
