<?php

namespace App\Filament\Resources\LpjResource\Pages;

use App\Filament\Resources\LpjResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLpjs extends ManageRecords
{
    protected static string $resource = LpjResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Unggah LPJ Baru'),
        ];
    }
}

