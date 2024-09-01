<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\ValidationHistoryItem;
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
        Schema::create((new ValidationHistoryItem)->getTable(), function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->index();
            $table->string('file_type');
            $table->string('verification_result');

            $table->foreign('user_id')->references('id')->on((new User)->getTable());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new ValidationHistoryItem)->getTable());
    }
};
