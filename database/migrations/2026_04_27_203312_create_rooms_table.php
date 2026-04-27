<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void {
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('address');
        $table->integer('price_hour');
        $table->integer('price_day')->nullable();
        $table->string('image')->nullable(); 
        $table->integer('capacity')->default(1);
        $table->time('work_start')->default('08:00');
        $table->time('work_end')->default('22:00');
        $table->timestamps();
    });
}
    public function down(): void { Schema::dropIfExists('rooms'); }
};