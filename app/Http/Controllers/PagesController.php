<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function dashboard()
    {
        $message = Message::count();
        $country = Daerah::count();
        $category = Category::count();
        $sender = Message::count();

        return view('dashboard', compact(
            'message',
            'country',
            'category',
            'sender',
        ));
    }
}
