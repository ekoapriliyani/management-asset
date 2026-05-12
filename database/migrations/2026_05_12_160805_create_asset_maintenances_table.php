<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
            $table->date('maintenance_date');
            $table->string('maintenance_type'); // preventive / corrective / repair
            $table->string('technician_name')->nullable();
            $table->decimal('cost', 15, 2)->default(0);
            $table->text('problem_description')->nullable();
            $table->text('action_taken')->nullable();
            $table->date('next_maintenance_date')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_maintenances');
    }
};
