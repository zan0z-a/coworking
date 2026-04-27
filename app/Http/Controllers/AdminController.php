<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Message;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller 
{
    private function checkAdmin() 
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Доступ запрещен');
        }
        return true;
    }

    public function index() 
    {
        if (!$this->checkAdmin()) return;
        $messages = Message::latest()->get();
        return view('admin.index', compact('messages'));
    }

    public function rooms() 
    {
        if (!$this->checkAdmin()) return;
        $rooms = Room::with('type')->get();
        $types = RoomType::all();
        return view('admin.rooms', compact('rooms', 'types'));
    }

    public function bookings()
    {
        if (!$this->checkAdmin()) return;
        $bookings = Booking::with(['user', 'room'])->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function deleteBooking($id)
    {
        if (!$this->checkAdmin()) return;
        $booking = Booking::find($id);
        if ($booking) {
            $booking->delete();
            return back()->with('success', 'Бронь удалена');
        }
        return back()->with('error', 'Бронь не найдена');
    }

       public function storeRoom(Request $request) 
    {
        if (!$this->checkAdmin()) return;
        
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'title' => 'required|max:255',
            'address' => 'required',
            'price_hour' => 'required|integer|min:0',
            'price_day' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'work_start' => 'required|date_format:H:i',
            'work_end' => 'required|date_format:H:i',
        ]);

        $data = $request->except('_token');
        
        if (empty($data['price_day'])) {
            $data['price_day'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        try {
            Room::create($data);
            return back()->with('success', 'Комната добавлена');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteRoom(Room $room) 
    {
        if (!$this->checkAdmin()) return;
        $room->delete();
        return back()->with('success', 'Комната удалена');
    }
}