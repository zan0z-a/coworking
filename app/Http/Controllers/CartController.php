<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('start_time', 'desc')
            ->get();

        return view('cart.index', compact('bookings'));
    }

    public function cancel($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->first();

        if ($booking) {
            $booking->delete();
            return back()->with('success', 'Бронь отменена');
        }

        return back()->with('error', 'Бронь не найдена');
    }
}