<?php

namespace App\Exports;

use App\Models\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MessagesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Message::with('kategoriMessages.kategori')->get()->map(function ($message) {
            // Combine categories and wishes into a single string
            $pengarepan = $message->kategoriMessages->map(function ($kategoriMessage) {
                return $kategoriMessage->kategori->nama . ' - ' . $kategoriMessage->wish;
            })->implode(', ');

            return [
                'Date' => $message->created_at->format('Y-m-d'),
                'Nama' => $message->nama,
                'Daerah' => $message->daerah->nama,
                'Pengarepan' => $pengarepan, // Concatenated categories and wishes
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Nama',
            'Daerah',
            'Pengarepan',
        ];
    }
}
