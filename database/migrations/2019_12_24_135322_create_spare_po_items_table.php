<?php

use App\BaseBlueprint;
use App\Enums\Condition;
use App\Enums\Quality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSparePoItemsTable extends Migration
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
        
     
        $schema->create('spare_po_items', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('spare_po_id')->unsigned();
            $table->foreign('spare_po_id')->references('id')->on('spare_pos');
            $table->bigInteger('spare_parts_id')->unsigned();
            $table->foreign('spare_parts_id')->references('id')->on('spare_parts');            
            $table->bigInteger('currency_id')->unsigned();          
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->double('rate', 8, 2);
            $table->double('quantity', 8, 2);
            $table->enum('quality', Quality::getValues());
            $table->enum('condition', Condition::getValues());
            $table->double('amount', 20, 2);
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
        Schema::dropIfExists('spare_po_items');
    }
}