<?php

namespace App\Filament\Resources\BukuNonTeksResource\Pages;

use App\Filament\Resources\BukuNonTeksResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBukuNonTeks extends ManageRecords
{
    protected static string $resource = BukuNonTeksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Buku Nonteks Baru'),
        ];
    }
}

