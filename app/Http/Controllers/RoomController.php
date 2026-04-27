<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller 
{
    public function index(Request $request) 
    {
        $query = Room::with('type');
        if ($request->type) {
            $query->where('room_type_id', $request->type);
        }
        $rooms = $query->get();
        $types = RoomType::all();
        return view('shop', compact('rooms', 'types'));
    }

    public function show(Room $room) 
    {
        return view('room', compact('room'));
    }

    public function bookingForm(Room $room)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите, чтобы арендовать помещение');
        }
        $rentType = request('type', 'hour'); 
        return view('booking_form', compact('room', 'rentType'));
    }

        public function book(Request $request, Room $room) 
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $startTime = null;
        $endTime = null;

        if ($request->rent_type === 'day') {
            $request->validate([
                'rent_date' => 'required|date'
            ]);
            $startTime = $request->rent_date . ' 00:00:00';
            $endTime = $request->rent_date . ' 23:59:59';
        } else {
            $request->validate([
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ]);
            $startTime = $request->start_time;
            $endTime = $request->end_time;

            $startHour = (int) date('H', strtotime($startTime));
            $endHour = (int) date('H', strtotime($endTime));
            $roomStart = (int) date('H', strtotime($room->work_start));
            $roomEnd = (int) date('H', strtotime($room->work_end));

            if ($startHour < $roomStart || $endHour > $roomEnd) {
                return redirect()->route('room.show', $room)->with('error', 'Ошибка: Аренда возможна только в рабочие часы (' . $room->work_start . ' - ' . $room->work_end . ')');
            }
        }

        $isBusy = Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereRaw('? < end_time AND ? > start_time', [$startTime, $endTime]);
            })->exists();

        if ($isBusy) {
            return redirect()->route('room.show', $room)->with('error', 'Ошибка: Это время уже занято другим пользователем.');
        }

        $price = $request->rent_type === 'hour' ? $room->price_hour : $room->price_day;
        $startTs = strtotime($startTime);
        $endTs = strtotime($endTime);
        
        if ($request->rent_type === 'hour') {
            $hours = ceil(($endTs - $startTs) / 3600);
            $total = $price * max(1, $hours);
        } else {
            $days = ceil(($endTs - $startTs) / 86400);
            $total = $price * max(1, $days);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'rent_type' => $request->rent_type,
            'total_price' => $total,
            'status' => 'confirmed'
        ]);

        return redirect()->route('home')->with('success', 'Помещение успешно забронировано!');
    }
}