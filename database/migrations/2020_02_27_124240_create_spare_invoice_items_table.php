<?php

use App\BaseBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareInvoiceItemsTable extends Migration
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
        
     
        $schema->create('spare_invoice_items', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('spare_invoice_id')->unsigned();
            $table->foreign('spare_invoice_id')->references('id')->on('spare_invoices');
            $table->bigInteger('spare_parts_id')->unsigned();
            $table->foreign('spare_parts_id')->references('id')->on('spare_parts');
            $table->bigInteger('spare_grn_items_id')->unsigned();
            $table->foreign('spare_grn_items_id')->references('id')->on('spare_grn_items');
            $table->double('rate', 20, 2); 
            $table->double('quantity' ,8, 2);  
            $table->double('amount', 20, 2);          
            $table->double('return' ,8, 2)->default(0);          
            $table->double('return_amount', 20, 2)->default(0); 
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
        Schema::dropIfExists('spare_invoice_items');
    }
}