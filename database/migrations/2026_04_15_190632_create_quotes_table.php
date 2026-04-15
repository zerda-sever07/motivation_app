<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *Run the migrations. */

    public function up(): void
{
    Schema::create('quotes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Sözü kim paylaştı?
        $table->text('content'); // Motivasyon sözünün kendisi
        $table->string('author')->default('Anonim'); // Sözün asıl sahibi
        $table->timestamps(); // Ne zaman eklendiğini otomatik tutar
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
