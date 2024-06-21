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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('user_id');
            $table->enum('status', ['Applied','Approved','Unapproved'])->nullable(false)->default('Applied');
            $table->dateTime('apply_date');
            $table->enum('leave_type', ['Fullday','Halfday']);
            $table->enum('seen_sts', ['seen','unseen'])->nullable(false)->default('unseen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
