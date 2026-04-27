<?php
namespace App\Http\Controllers;
use App\Models\Room;

class HomeController extends Controller {
    public function index() {
        $featuredRooms = Room::with('type')->take(2)->get();
        return view('index', compact('featuredRooms'));
    }
}