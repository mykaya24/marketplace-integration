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
        Schema::create("order_integrations",function(Blueprint $table){
            $table->id();
            $table->foreignId('order_id')
                    ->constrained('orders')
                    ->cascadeOnDelete(); // ON DELETE CASCADE
            $table->string("system_name");
            $table->string("status");
            $table->string("http_status")->nullable();
            $table->json("response_body")->nullable();
            $table->integer("retry_count")->default(0);
            $table->text("last_error")->nullable();
            $table->timestamp("sent_at")->nullable();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
            $table->unique(['order_id', 'system_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_integrations');
    }
};
