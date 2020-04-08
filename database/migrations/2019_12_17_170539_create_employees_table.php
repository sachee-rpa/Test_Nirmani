<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = DB::getSchemaBuilder();

        $schema->blueprintResolver(function ($table, $callback) {
            return new BaseBlueprint($table, $callback);
        });
        
        $schema->create('employees', function($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('initial');
            $table->string('nic_number')->unique();
            $table->bigInteger('employee_category_id')->unsigned();
            $table->foreign('employee_category_id')->references('id')->on('employee_categories');
            $table->string('designation')->nullable();;
            $table->date('join_date');
            $table->double('day_rate', 8, 2)->nullable();
            $table->double('ot_rate', 8, 2)->nullable();
            $table->string('remark')->nullable();
            $table->string('file')->nullable(); 
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}