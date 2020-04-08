<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMachineriesTable extends Migration
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
        
        $schema->create('machineries', function($table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('brand_model_id')->unsigned();
            $table->foreign('brand_model_id')->references('id')->on('brand_models');
            $table->bigInteger('machine_id')->unsigned();
            $table->foreign('machine_id')->references('id')->on('machines');            
            $table->string('name')->unique();
            $table->double('market_rate', 8, 2)->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('machineries');
    }
}