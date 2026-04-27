<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); 
            $table->string('name'); 
            $table->timestamps();
        });
        
        \DB::table('room_types')->insert([
            ['key' => 'meeting_room', 'name' => 'Переговорная'],
            ['key' => 'workplace', 'name' => 'Рабочее место'],
            ['key' => 'conference_hall', 'name' => 'Конференц-зал'],
        ]);
    }
    public function down(): void { Schema::dropIfExists('room_types'); }
};