<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
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
        
        $schema->create('customers', function($table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('vat')->nullable();
            $table->string('svat')->nullable();

            $table->string('fixed_line')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
         
            $table->boolean('credit')->default(false);
            $table->integer('spare')->unsigned()->nullable();
            $table->integer('machinery')->unsigned()->nullable();
            $table->integer('service')->unsigned()->nullable();
            $table->integer('discount_spare')->unsigned()->default(0);
            $table->integer('discount_machinery')->unsigned()->default(0);
            $table->integer('discount_service')->unsigned()->default(0);
            $table->string('remark')->nullable();
            
            $table->commonFields();
        });

        $schema->blueprintResolver(function($table, $callback) {
            return new BaseBlueprint($table, $callback);
        });
    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}