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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('purpose', 16)->nullable()->default(null);
            $table->unsignedBigInteger('sort')->default(999);
            $table->string('title', 100);
            $table->json('content')->nullable()->default(null);
            $table->foreignIdFor(User::class);
            $table->bigInteger('blockable_id')->unsigned();
            $table->string('blockable_type', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
