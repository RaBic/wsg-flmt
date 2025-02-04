<?php

use App\Models\Centre;
use App\Models\Study;
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
        Schema::create('study_centre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Study::class);
            $table->foreignIdFor(Centre::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_centre');
    }
};
