<?php

use App\BaseBlueprint;
use App\Enums\SparePart\CustomerType;
use App\Enums\SparePart\InvoiceType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpareInvoicesTable extends Migration
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
        
        $schema->create('spare_invoices', function($table) {
            $table->bigIncrements('id');   
            $table->enum('invoice_type', InvoiceType::getValues());
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->date('date');         
            $table->bigInteger('customer_po_id')->nullable()->unsigned()->default(NULL);
            $table->foreign('customer_po_id')->references('id')->on('customer_pos');
            $table->enum('customer_type', CustomerType::getValues());


            $table->bigInteger('mr_number')->nullable()->unsigned()->default(NULL);
            $table->bigInteger('job_number')->nullable()->unsigned()->default(NULL);
       
            $table->double('vat_percentage', 8, 2);
            $table->double('nbt_percentage', 8, 2);    
            $table->double('vat', 20, 2);
            $table->double('nbt', 20, 2);    
            $table->string('remarks')->nullable();
            $table->double('sub_total', 20, 2);
            $table->double('after_discount', 20, 2);
            $table->double('discount_percentage', 8, 2);
            $table->double('discount', 20, 2);
            $table->double('total_amount', 20, 2);
            $table->double('total_return_amount', 20, 2)->default(0);
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
        Schema::dropIfExists('spare_invoices');
    }
}