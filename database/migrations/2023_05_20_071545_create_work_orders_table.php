<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('code')->unique();
            $table->date('date');
            $table->string('category');
            $table->string('name');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('phone');
            $table->string('order');
            $table->string('description');
            $table->string('level');
            $table->string('note')->nullable();
            $table->integer('status')->default(1);
            $table->integer('active')->default(1);
            $table->dateTime('start_order')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->dateTime('end_order')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
