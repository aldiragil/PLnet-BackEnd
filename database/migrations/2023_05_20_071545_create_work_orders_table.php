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
            $table->integer('id_status')->default(0);
            $table->string('code')->unique();
            $table->string('referensi')->nullable();
            $table->dateTime('date');
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
            $table->string('status');
            $table->boolean('create_allowed')->default(false);
            $table->integer('active')->default(1);
            $table->dateTime('start_order')->nullable();
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
