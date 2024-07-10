<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users', 'id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('started_at')->useCurrent()->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->integer('duration')->comment('Elapsed duration in seconds')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_logs');
    }
};
