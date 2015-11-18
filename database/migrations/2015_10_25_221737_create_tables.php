<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('instruction')->default('');
            $table->boolean('is_rev_aid')->default(false);
            $table->boolean('is_eap')->default(false);
            $table->timestamps();
        });
        Schema::create('ppo_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->date('dob');
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('regimens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('code')->unique();
            $table->timestamps();
        });
        Schema::create('lucodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->integer('medication_id')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('diagnosis_primary_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->timestamps();
        });
        Schema::create('diagnosis_secondary_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('diagnosis_primary_category_id')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('diagnosis_secondary_category_id')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('dose_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('mitte_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('dose_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('dose_calculation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('dose_modification_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('ppos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('version')->default('1');
            $table->boolean('is_active')->default(false);
            $table->integer('regimen_id')->unsigned()->default(0);
            $table->boolean('is_start_date')->default(true);
            $table->boolean('is_cycle')->default(true);
            $table->boolean('is_dose_reason')->default(true);
            $table->boolean('is_bsa')->default(true);
            $table->integer('cycle_days');
            $table->timestamps();
        });
        Schema::create('ppo_dose_modification_reasons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->foreign('ppo_id')->references('id')->on('ppos')->onDelete('cascade');
            $table->integer('dose_modification_reason_id')->unsigned()->default(0);
            $table->foreign('dose_modification_reason_id')->references('id');
        });
        Schema::create('ppo_diagnoses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->foreign('ppo_id')->references('id')->on('ppos')->onDelete('cascade');
            $table->integer('diagnosis_id')->unsigned()->default(0);
            $table->foreign('diagnosis_id')->references('id')->on('diagnosis')->onDelete('cascade');
        });
        Schema::create('ppo_items', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_active')->default(false);
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->foreign('ppo_id')->references('id')->on('ppos')->onDelete('cascade');
            $table->integer('medication_id');
            $table->decimal('dose_base',7,2);
            $table->integer('dose_unit_id');
            $table->integer('dose_route_id');
            $table->integer('dose_calculation_type_id');
            $table->integer('ppo_section_id');
            $table->decimal('fixed_dose_result',7,2);
            $table->string('instruction');
            $table->string('note_to_md');
            $table->boolean('is_instruction_input');
            $table->boolean('is_start_date')->default(false);
            $table->boolean('is_duration_input')->default(false);
            $table->boolean('is_frequency_input')->default(false);
            $table->boolean('is_mitte_input')->default(true);
            $table->integer('mitte_unit_id');
            $table->boolean('is_repeat_input')->default(true);
            $table->timestamps();
        });
        Schema::create('ppo_item_lucodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ppo_item_id')->unsigned()->default(0);
            $table->foreign('ppo_item_id')->references('id')->on('ppo_items')->onDelete('cascade');
            $table->integer('lucode_id')->unsigned()->default(0);
            $table->foreign('lucode_id')->references('id')->on('lucodes')->onDelete('cascade');
        });
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->integer('regimen_id')->unsigned()->default(0);
            $table->foreign('regimen_id')->references('id')->on('regimens');
            $table->integer('diagnosis_id')->unsigned()->default(0);
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses');
            $table->boolean('is_start_date')->default(true);
            $table->boolean('is_bsa')->default(true);
            $table->boolean('is_cycle')->default(true);
            $table->boolean('is_dose_reason')->default(true);
            $table->integer('cycle_id')->nullable();
            $table->integer('cycle_days')->nullable();
            $table->date('start_date');
            $table->date('final_date')->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 5, 2->nullable();
            $table->decimal('bsa', 3, 2)->nullable();
            $table->string('allergies')->default('');
            $table->string('other_dose_modification_reason')->nullable();
            $table->boolean('is_allergies_unknown')->default(false);
            $table->boolean('is_allergies')->default(false);
            $table->boolean('is_final')->default(false);
            $table->boolean('is_void')->default(false);
            $table->timestamps();
        });
        Schema::create('prescription_operation_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->string('op')->default('');
            $table->string('reason');
            $table->boolean('done')->default(false);
            $table->timestamps();
        });
        Schema::create('prescription_dose_modification_reasons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->integer('dose_modification_reason_id')->unsigned()->default(0);
            $table->foreign('dose_modification_reason_id')->references('id')->on('dose_modification_reasons')->onDelete('cascade');
        });
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_selected')->default(true);
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->integer('ppo_id');
            $table->foreign('ppo_id')->references('id')->on('ppos');
            $table->integer('ppo_section_id');
            $table->foreign('ppo_section_id')->references('id')->on('ppo_sections');
            $table->integer('ppo_item_id');
            $table->foreign('ppo_item_id')->references('id')->on('ppo_items');
            $table->integer('medication_id');
            $table->foreign('medication_id')->references('id')->on('medications');
            $table->string('medication_name');
            $table->integer('lucode_id')->nullable();
            $table->foreign('lucode_id')->references('id')->on('lucodes');
            $table->string('medication_common_instruction')->nullable();
            $table->date('start_date')->nullable();
            $table->decimal('dose_base',7,2)->nullable();
            $table->integer('dose_unit_id')->unsigned()->default(0);
            $table->foreign('dose_unit_id')->references('id')->on('dose_units');
            $table->integer('dose_route_id')->unsigned()->default(0);
            $table->foreign('dose_route_id')->references('id')->on('dose_routes');
            $table->integer('dose_calculation_type_id');
            $table->decimal('dose_percentage',5,2)->nullable();
            $table->decimal('dose_result',7,2);
            $table->string('instruction')->nullable();
            $table->string('note_to_md')->nullable();
            $table->boolean('is_instruction_input')->default(false);
            $table->string('instruction_input')->nullable();
            $table->boolean('is_duration_input')->default(false);
            $table->integer('duration')->nullable();
            $table->boolean('is_frequency_input')->default(false);
            $table->string('frequency')->nullable();
            $table->boolean('is_mitte_input')->default(true);
            $table->decimal('mitte',5,2);
            $table->integer('mitte_unit_id')->unsigned()->default(0);
            $table->foreign('mitte_unit_id')->references('id')->on('mitte_units');
            $table->boolean('is_repeat_input')->default(false);
            $table->integer('repeat')->nullable();
            $table->boolean('is_dose_notation')->default(false);
            $table->boolean('is_frequency_notation')->default(false);
            $table->boolean('is_rev_aid_enrolled')->default(false);
            $table->boolean('is_eap_approved')->default(false);
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
        Schema::drop('prescription_items');
        Schema::drop('prescription_dose_modification_reasons');
        Schema::drop('prescription_operation_records');
        Schema::drop('prescriptions');
        Schema::drop('ppo_dose_modification_reasons');
        Schema::drop('ppo_item_lucodes');
        Schema::drop('ppo_items');
        Schema::drop('ppo_diagnoses');
        Schema::drop('ppos');
        Schema::drop('dose_modification_reasons');
        Schema::drop('dose_routes');
        Schema::drop('dose_calculation_types');
        Schema::drop('mitte_units');
        Schema::drop('dose_units');
        Schema::drop('regimens');
        Schema::drop('diagnoses');
        Schema::drop('patients');
        Schema::drop('ppo_sections');
        Schema::drop('medications');
        Schema::drop('lucodes');
        Schema::drop('diagnosis_secondary_categories');
        Schema::drop('diagnosis_primary_categories');
    }
}
