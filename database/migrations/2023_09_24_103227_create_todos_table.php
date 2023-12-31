<?php

use App\Enums\Period;
use App\Enums\TodoStatus;
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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('status')->default(TodoStatus::PENDING);
            $table->integer('order')->default(0);
            $table->float('quantity')->default(5);
            $table->string('period')->default(Period::SECONDS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
