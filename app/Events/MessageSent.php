<?php

namespace App\Events;

use App\Models\Daerah;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('messages'),
        ];
    }


    public function broadcastAs(): string
    {
        return 'new-message';
    }

    public function broadcastWith()
    {
        $regions = Message::selectRaw("COUNT(*) as count, daerah_id")
            ->groupBy('daerah_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Daerah::find($item->daerah_id)->nama => $item->count];
            });

        $categories = Message::selectRaw("COUNT(*) as count, category_id")
            ->groupBy('category_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Category::find($item->category_id)->nama => $item->count];
            });

        return [
            'created_at' => $this->message->created_at,
            'nama' => $this->message->nama,
            'pekerjaan' => $this->message->pekerjaan,
            'whatsapp' => $this->message->whatsapp,
            'email' => $this->message->email,
            'usia' => $this->message->usia,
            'daerah' => $this->message->daerah->name,
            'category' => $this->message->category->name,
            'pengarepan' => $this->message->pengarepan,
            'message_count' => Message::count(),
            'sender_count' => Message::count(),
            'chartData' => [
                'regions' => $regions,
                'categories' => $categories,
            ],
        ];
    }
}
