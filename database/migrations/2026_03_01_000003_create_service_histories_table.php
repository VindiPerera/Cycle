<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bicycle_id')->constrained()->onDelete('cascade');
            $table->date('service_date');
            $table->string('service_type');
            $table->text('description')->nullable();
            $table->text('parts_replaced')->nullable();
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->string('mechanic_name')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_histories');
    }
};
