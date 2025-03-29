<?php

use App\Models\User;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('purpose', 16)->nullable()->default(null);
            $table->integer('sort')->unsigned()->default(0);
            $table->json('meta')->nullable()->default(null);
            $table->foreignIdFor(User::class);
            $table->bigInteger('imageable_id')->unsigned();
            $table->string('imageable_type', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
