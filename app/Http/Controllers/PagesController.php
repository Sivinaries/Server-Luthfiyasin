<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Message;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\KategoriMessage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PagesController extends Controller
{
    public function dashboard()
    {
        $nama = Message::pluck('nama');
        $message = Message::count();
        $sender = Message::count();

        // CHARTS DAERAH - Count messages by region (daerah)
        $grafikDaerah = Message::selectRaw("COUNT(*) as count, daerah_id")
            ->groupBy('daerah_id') // Group by region (daerah)
            ->get();

        $labels1 = [];
        $data1 = [];
        $colors1 = [];

        $availableColors1 = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(200, 200, 0, 0.2)',
            'rgba(100, 100, 200, 0.2)',
            'rgba(200, 100, 200, 0.2)',
            'rgba(100, 255, 100, 0.2)',
        ];

        foreach ($grafikDaerah as $index => $data) {
            $regionName = Daerah::find($data->daerah_id)->nama;
            $labels1[] = $regionName;
            $data1[] = $data->count;

            $colors1[] = $availableColors1[$index % count($availableColors1)];
        }

        // CHARTS CATEGORY - Count messages by category
        $grafikCategory = KategoriMessage::selectRaw("COUNT(*) as count, kategori_id")
            ->groupBy('kategori_id') // Group by region (daerah)
            ->get();

        $labels2 = [];
        $data2 = [];
        $colors2 = [];

        $availableColors2 = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(200, 200, 0, 0.2)',
            'rgba(100, 100, 200, 0.2)',
            'rgba(200, 100, 200, 0.2)',
            'rgba(100, 255, 100, 0.2)',
        ];

        foreach ($grafikCategory as $index => $data) {
            $categoryName = Kategori::find($data->kategori_id)->nama;
            $labels2[] = $categoryName;
            $data2[] = $data->count;

            $colors2[] = $availableColors2[$index % count($availableColors2)];
        }

        return view('dashboard', compact(
            'nama',
            'message',
            'sender',
            'labels1',
            'data1',
            'colors1',
            'labels2',
            'data2',
            'colors2',
        ));
    }

    public function search(Request $request)
    {

        $query = $request->input('search');

        //MESSAGE SEARCH
        $messages = Message::where('nama', 'LIKE', '%' . $query . '%')
            ->get();

        //COUNTRY SEARCH
        $daerahs = Daerah::where('nama', 'LIKE', '%' . $query . '%')
            ->get();

        //CATEGORY SEARCH
        $categories = Kategori::where('nama', 'LIKE', '%' . $query . '%')
            ->get();

        //SENDER SEARCH
        $senders = Message::where('nama', 'LIKE', '%' . $query . '%')
            ->get();


        return view('search', compact(
            'messages',
        ));
    }

    public function barcode()
    {
        $url = "https://ngopeninglakoni.id/";

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->generate($url);

        return view('barcode', ['qrCode' => $qrCode]);
    }


}
