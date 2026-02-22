<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("orders",function(Blueprint $table){
            $table->id();
            $table->string("order_id")->unique();
            $table->date("date");
            $table->string("category");
            $table->string("shipping_customer");
            $table->string("shipping_adress");
            $table->string("shipping_phone");
            $table->string("shipping_city");
            $table->string("shipping_town");
            $table->string("billing_customer");
            $table->string("billing_tc_no",11)->nullable();
            $table->string("billing_tax_number")->nullable();
            $table->string("billing_tax_office")->nullable();
            $table->string("billing_adress");
            $table->string("billing_phone");
            $table->string("billing_city");
            $table->string("billing_town");
            $table->string("order_number")->unique();
            $table->string("send_type");
            $table->string("description");
            $table->string("barkod");
            $table->string("invoice_number");
            $table->float("commission_amount",2)->nullable();
            $table->float("commission_rate",2)->nullable();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
