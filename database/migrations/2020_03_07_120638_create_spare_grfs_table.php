<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareGrfsTable extends Migration
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
             
        $schema->create('spare_grves', function(Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('spare_gin_id')->unsigned();
            $table->foreign('spare_gin_id')->references('id')->on('spare_gins');
            $table->date('date');         
            $table->string('remarks')->nullable();
            $table->double('total_return_amount', 20, 2);
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
        Schema::dropIfExists('spare_grves');
    }
}