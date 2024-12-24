<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Cache::remember('messages', now()->addMinutes(60), function () {
            return Message::with('kategoriMessages.kategori')->get();
        });

        return view('message', compact('messages'));
    }

    public function destroy($id)
    {
        Message::destroy($id);

        Cache::put('messages', Message::all(), now()->addMinutes(60));

        return redirect(route('message'))->with('success', 'Message successfully deleted!');
    }
}
