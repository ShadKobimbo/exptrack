<?php

use App\Models\Shop;
use App\Models\User;
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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->longText('description');
            $table->foreignIdFor(Shop::class);
            $table->integer('account_debited');
            $table->string('supplier_paid');
            $table->integer('supplier_contact');
            $table->integer('amount');
            $table->string('transaction_number');
            $table->longText('evidence_path')->nullable();
            $table->string('status')->default('submitted'); // or use 'pending', 'draft', etc.
            $table->date('expense_date')->nullable(); // Allow null for existing records
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
