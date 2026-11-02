<?php

namespace App\Filament\Resources\NavigationResource\Pages;

use App\Filament\Resources\NavigationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNavigations extends ManageRecords
{
    protected static string $resource = NavigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Menu Baru'),
        ];
    }
}

