<?php

use App\BaseBlueprint;
use App\Enums\Condition;
use App\Enums\Quality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareGrnItemsTable extends Migration
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
        
     
        $schema->create('spare_grn_items', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('spare_grn_id')->unsigned();
            $table->foreign('spare_grn_id')->references('id')->on('spare_grns');
            $table->bigInteger('spare_parts_id')->unsigned();
            $table->foreign('spare_parts_id')->references('id')->on('spare_parts');            
            $table->bigInteger('currency_id')->unsigned();          
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->double('rate', 8, 2);
            $table->bigInteger('unit_id')->unsigned();          
            $table->foreign('unit_id')->references('id')->on('units');
            $table->double('quantity', 8, 2);       
            $table->enum('quality', Quality::getValues());
            $table->enum('condition', Condition::getValues());
            $table->double('unit_sell_price', 20, 2);
            $table->double('amount', 20, 2);
            $table->double('sell_price', 20, 2);
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
        Schema::dropIfExists('spare_grn_items');
    }
}