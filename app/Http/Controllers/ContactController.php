<?php
namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() { return view('contacts'); }
    
    public function send(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'question' => 'required|min:5'
        ]);
        Message::create($request->only('email', 'question'));
        return back()->with('success', 'Сообщение отправлено!');
    }
}