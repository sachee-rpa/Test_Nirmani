<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareGrnsTable extends Migration
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
        
        $schema->create('spare_grns', function($table) {
            $table->bigIncrements('id');   
            $table->bigInteger('spare_po_id')->nullable()->unsigned()->default(NULL);
            $table->foreign('spare_po_id')->references('id')->on('spare_pos');
            $table->bigInteger('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->date('date');         
            $table->string('invoice_number');
            $table->string('remarks')->nullable();
            $table->double('total_amount', 20, 2);
            $table->double('total_sell_amount', 20, 2);
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
        Schema::dropIfExists('spare_grns');
    }
}