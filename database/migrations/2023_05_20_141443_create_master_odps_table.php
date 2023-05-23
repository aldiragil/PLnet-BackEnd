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
        Schema::create('master_odps', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('serial');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('device');
            $table->string('slot');
            $table->string('port');
            $table->string('capacity');
            $table->string('image');
            $table->string('note');
            $table->integer('active');
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
        Schema::dropIfExists('master_odps');
    }
};
