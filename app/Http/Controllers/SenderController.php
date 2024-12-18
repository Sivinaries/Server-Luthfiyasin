<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class SenderController extends Controller
{
    public function index ()
    {
        $senders = Cache::remember('messages', now()->addMinutes(60), function () {
            return Message::all();
        });
        return view('sender', compact('senders'));
    }
}
