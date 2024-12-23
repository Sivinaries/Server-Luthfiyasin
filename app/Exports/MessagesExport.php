<?php

namespace App\Exports;

use App\Models\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MessagesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Message::with('category', 'daerah')->get()->map(function ($message) {
            return [
                'Date' => $message->created_at->format('Y-m-d'),
                'Kategori' => $message->category->nama,
                'Nama' => $message->nama,
                'Daerah' => $message->daerah->nama,
                'Pengarepan' => $message->pengarepan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Kategori',
            'Nama',
            'Daerah',
            'Pengarepan',
        ];
    }
}
