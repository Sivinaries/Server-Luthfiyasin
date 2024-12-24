<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DaerahController extends Controller
{
    public function index()
    {
        $daerahs = Cache::remember('daerahs', now()->addMinutes(60), function () {
            return Daerah::all();
        });

        return view('daerah', compact('daerahs'));
    }

    public function create()
    {
        return view('adddaerah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
        ]);

        Daerah::create($data);

        Cache::put('daerahs', Daerah::all(), now()->addMinutes(60));

        return redirect(route('country'))->with('success', 'Country successfully created!');
    }

    public function destroy($id)
    {
        Daerah::destroy($id);

        Cache::put('daerahs', Daerah::all(), now()->addMinutes(60));

        return redirect(route('country'))->with('success', 'Country successfully deleted!');
    }
}
