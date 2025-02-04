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
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->string('shortcode', 32);
            $table->string('slug', 32);
            $table->text('title');
            $table->set('type', ['recruiting', 'followup']);
            $table->json('content')->nullable()->default(null);
            $table->unsignedBigInteger('sort')->default(999);
            $table->dateTime('published_at')->nullable()->default(null);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
