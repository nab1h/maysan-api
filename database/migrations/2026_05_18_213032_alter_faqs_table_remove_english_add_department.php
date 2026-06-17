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
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_en', 'answer_en']);
            $table->foreignId('department_id')->after('id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_en')->nullable();
            $table->text('answer_en')->nullable();
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
