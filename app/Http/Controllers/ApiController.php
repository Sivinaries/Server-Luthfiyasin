<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Message;
use App\Models\Category;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function daerah()
    {
        $daerahs = Cache::remember('daerahs', now()->addMinutes(60), function () {
            return Daerah::all();
        });

        return response()->json([
            'daerahs' => $daerahs,
        ], 200);
    }

    public function category()
    {
        $categories = Cache::remember('categories', now()->addMinutes(60), function () {
            return Category::all();
        });

        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    public function message()
    {
        $messages = Cache::remember('messages', now()->addMinutes(60), function () {
            return Message::with('category', 'daerah')->get();
        });

        return response()->json([
            'messages' => $messages,
        ], 200);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'pekerjaan' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'usia' => 'required',
            'pengarepan' => 'required',
            'daerah_id' => 'required',
            'category_id' => 'required',
        ]);

        $message = Message::create($data);

        event(new MessageSent($message));

        Cache::put('messages', Message::all(), now()->addMinutes(60));

        return response()->json([
            'message' => $message,
        ], 200);
    }
}
