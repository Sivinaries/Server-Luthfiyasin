<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Cache::remember('kategoris', now()->addMinutes(60), function () {
            return Kategori::all();
        });

        return view('category', compact('kategoris'));
    }

    public function create()
    {
        return view('addcategory');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
        ]);

        Kategori::create($data);

        Cache::put('kategoris', Kategori::all(), now()->addMinutes(60));

        return redirect(route('category'))->with('success', 'Category successfully created!');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama']));

        Cache::put('kategoris', Kategori::all(), now()->addMinutes(60));

        return redirect(route('category'))->with('success', 'Category successfully updated!');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);

        Cache::put('kategoris', Kategori::all(), now()->addMinutes(60));

        return redirect(route('category'))->with('success', 'Category successfully deleted!');
    }
}
