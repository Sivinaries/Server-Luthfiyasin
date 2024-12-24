<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Message;
use App\Models\Kategori;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\KategoriMessage;
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
        $kategoris = Cache::remember('kategoris', now()->addMinutes(60), function () {
            return Kategori::all();
        });

        return response()->json([
            'categories' => $kategoris,
        ], 200);
    }

    public function message()
    {
        $messages = Message::with('kategoriMessages.kategori')->get(); // Eager load kategori through kategoriMessages

        return response()->json([
            'messages' => $messages,
        ], 200);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'usia' => 'required|integer',
            'daerah_id' => 'required|integer',
            'kategori_messages' => 'required|array',
            'kategori_messages.*.kategori_id' => 'required|integer',
            'kategori_messages.*.wish' => 'nullable|string|max:255',
        ]);

        $message = Message::create([
            'nama' => $validated['nama'],
            'pekerjaan' => $validated['pekerjaan'],
            'whatsapp' => $validated['whatsapp'],
            'email' => $validated['email'],
            'usia' => $validated['usia'],
            'daerah_id' => $validated['daerah_id'],
        ]);

        $filteredKategoriMessages = array_filter($validated['kategori_messages'], function ($item) {
            return !is_null($item['wish']); // Only include kategori_messages with non-null 'wish'
        });

        foreach ($filteredKategoriMessages as $kategoriMessage) {
            $message->kategoriMessages()->create([
                'kategori_id' => $kategoriMessage['kategori_id'],
                'wish' => $kategoriMessage['wish'],
            ]);
        }

        event(new MessageSent($message));

        Cache::put('messages', Message::all(), now()->addMinutes(60));

        return response()->json([
            'message' => 'Message successfully created',
            'data' => $message->load('kategoriMessages.kategori') // Load the related kategori data
        ], 201);
    }
}
