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
        Schema::create('instalations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('work_order_id')->unique();
            $table->integer('customer_id');
            $table->integer('package_id');
            $table->integer('duedate_id');
            $table->integer('odp_id');
            $table->integer('status_id')->default(1);
            $table->dateTime('date');
            $table->string('event')->nullable();
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('instalations');
    }
};
