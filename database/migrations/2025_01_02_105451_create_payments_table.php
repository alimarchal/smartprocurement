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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->foreignId('invoice_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method'); // bank_transfer/cash/cheque
            $table->string('reference_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('completed'); // pending/completed/failed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
