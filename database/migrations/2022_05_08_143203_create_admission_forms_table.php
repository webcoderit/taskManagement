<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->string('s_name');
            $table->string('s_email')->nullable();
            $table->string('s_phone');
            $table->string('dob');
            $table->string('profession');
            $table->string('gender');
            $table->string('blood_group');
            $table->string('qualification');
            $table->string('nid');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('batch_no');
            $table->string('batch_type');
            $table->string('class_shedule');
            $table->string('class_time');
            $table->string('f_name');
            $table->string('f_phone');
            $table->string('m_name');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_forms');
    }
}
