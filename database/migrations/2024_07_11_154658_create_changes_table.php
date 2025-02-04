<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('change_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->bigInteger('model_id')->unsigned()->nullable()->default(null);
            $table->string('action');
            /* $table->string('field');
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('changeable_id')->nullable()->constrained();
            $table->string('changeable_type')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('tags')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('status')->nullable();
            $table->string('exception')->nullable();
            $table->string('exception_message')->nullable();
            $table->string('exception_file')->nullable(); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changes');
    }
};
