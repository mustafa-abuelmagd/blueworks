<?php

use App\Models\ClockIn;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clock_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained();
            $table->enum('type', ClockIn::TYPES)->default(ClockIn::IN);
            $table->decimal('longitude', 10, 8);
            $table->decimal('latitude', 10, 8);
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clock_ins');
    }
};
