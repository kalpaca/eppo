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
            $table->string('name');
            $table->string('instruction');
            $table->timestamps();
        });
        Schema::create('ppo_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });       
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('dob');
            $table->timestamps();
        });        
        Schema::create('regimens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('lucodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->integer('medication_id')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('dose_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('dose_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('dose_calculation_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('dose_modification_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('ppos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version')->default('1');
            $table->boolean('is_active')->default(false);
            $table->integer('regimen_id')->unsigned()->default(0);
            $table->foreign('regimen_id')->references('id')->on('regimens')->onDelete('cascade');
            $table->boolean('is_start_date')->default(true);
            $table->timestamps();
        }); 
        Schema::create('ppos_dose_modification_reasons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->foreign('ppo_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->integer('dose_modification_reason_id')->unsigned()->default(0);
            $table->foreign('dose_modification_reason_id')->references('id')->on('dose_modification_reasons')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('dosing_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->foreign('ppo_id')->references('id')->on('ppos')->onDelete('cascade');
            $table->integer('medication_id');
            $table->decimal('dose_base',7,2);
            $table->integer('dose_unit_id');
            $table->integer('dose_route_id');
            $table->integer('dose_calulation_type_id');
            $table->integer('ppo_section_id');
            $table->decimal('fixed_dose_result',7,2);
            $table->string('instruction');
            $table->boolean('is_instruction_input');
            $table->boolean('is_start_date')->default(false);
            $table->boolean('is_duration_input')->default(false);
            $table->boolean('is_frequency_input')->default(false);
            $table->boolean('is_mitte_input')->default(true);
            $table->string('mitte_unit');
            $table->boolean('is_repeat_input')->default(true);
            $table->timestamps();
        }); 
        Schema::create('dosing_schedule_lucodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dosing_schedule_id')->unsigned()->default(0);
            $table->foreign('dosing_schedule_id')->references('id')->on('dosing_schedules')->onDelete('cascade');
            $table->integer('lucode_id')->unsigned()->default(0);
            $table->foreign('lucode_id')->references('id')->on('lucodes')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('ppo_id')->unsigned()->default(0);
            $table->integer('regimen_id')->unsigned()->default(0);
            $table->integer('diagnosis_id')->unsigned()->default(0);
            $table->integer('cycle');
            $table->integer('cycle_days');
            $table->date('start_date');
            $table->date('final_date');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->decimal('bsa', 3, 2);
            $table->string('allergies');
            $table->boolean('is_allergies_unknown')->default(false);
            $table->boolean('is_allergies')->default(false);
            $table->boolean('is_final')->default(false);
            $table->timestamps();
        }); 
        Schema::create('prescription_operation_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->string('op');
            $table->string('reason');
            $table->boolean('done')->default(false);
            $table->timestamps();
        }); 
        Schema::create('prescriptions_dose_modification_reasons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->integer('dose_modification_reason_id')->unsigned()->default(0);
            $table->foreign('dose_modification_reason_id')->references('id')->on('dose_modification_reasons')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->integer('prescription_id')->unsigned()->default(0);
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->integer('ppo_id');
            $table->integer('ppo_section_id');
            $table->integer('dosing_schedule_id');
            $table->integer('medication_id');
            $table->string('medication_name');
            $table->string('medication_common_instruction');
            $table->date('start_date');
            $table->decimal('dose_base',7,2);
            $table->string('dose_unit');
            $table->string('dose_route');
            $table->string('dose_calulation_type');
            $table->decimal('dose_percentage',5,2);
            $table->decimal('dose_result',7,2);
            $table->string('instruction');
            $table->string('is_instruction_input');
            $table->string('instruction_input');
            $table->boolean('is_duration_input')->default(false);
            $table->integer('duration');
            $table->boolean('is_frequency_input')->default(false);
            $table->string('frequency');
            $table->boolean('is_mitte_input')->default(true);
            $table->decimal('mitte',5,2);
            $table->string('mitte_unit');
            $table->boolean('is_repeat_input')->default(false);
            $table->integer('repeat');
            $table->boolean('is_dose_notation')->default(false);
            $table->boolean('is_frequency_notation')->default(false);
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
        Schema::drop('prescriptions_dose_modification_reasons');
        Schema::drop('prescription_operation_records');
        Schema::drop('prescriptions');
        Schema::drop('ppos_dose_modification_reasons');
        Schema::drop('dosing_schedule_lucodes');
        Schema::drop('dosing_schedules');
        Schema::drop('ppos');
        Schema::drop('dose_modification_reasons');
        Schema::drop('dose_routes');
        Schema::drop('dose_calulation_types');
        Schema::drop('dose_units');
        Schema::drop('regimens');
        Schema::drop('diagnoses');
        Schema::drop('patients');
        Schema::drop('ppo_sections');
        Schema::drop('medications');
        Schema::drop('lucodes');
    }
}
