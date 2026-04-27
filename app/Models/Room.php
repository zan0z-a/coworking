<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model {
protected $fillable = ['room_type_id', 'title', 'description', 'address', 'price_hour', 'price_day', 'image', 'capacity', 'work_start', 'work_end'];
    public function type() { return $this->belongsTo(RoomType::class, 'room_type_id'); }
    public function bookings() { return $this->hasMany(Booking::class); }
}