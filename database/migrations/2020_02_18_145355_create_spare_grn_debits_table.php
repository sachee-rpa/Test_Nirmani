<?php

use App\BaseBlueprint;
use App\Enums\SparePart\GrnDebitMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareGrnDebitsTable extends Migration
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
        
            $schema->create('spare_grn_debits', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('debits_method', GrnDebitMethod::getValues());
            $table->bigInteger('spare_grn_item_id')->unsigned();
            $table->foreign('spare_grn_item_id')->references('id')->on('spare_grn_items')->onDelete('cascade');           
            $table->bigInteger('spare_parts_id')->unsigned();
            $table->foreign('spare_parts_id')->references('id')->on('spare_parts');   
            $table->integer('debit')->unsigned();      
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
        Schema::dropIfExists('spare_grn_debits');
    }
}