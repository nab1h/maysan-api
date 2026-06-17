<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('guests');
            $table->string('email')->after('phone')->nullable();
            $table->foreignId('location_id')->after('email')->nullable()->constrained('locations')->nullOnDelete();
            $table->foreignId('branch_id')->after('location_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('department_id')->after('branch_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('service_id')->after('department_id')->nullable()->constrained('services')->nullOnDelete();
            $table->foreignId('doctor_id')->after('service_id')->nullable()->constrained('doctors')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('guests')->default(1);
            $table->dropColumn('email');
            $table->dropForeign(['location_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['location_id', 'branch_id', 'department_id', 'service_id', 'doctor_id']);
        });
    }
};
