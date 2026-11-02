<?php

namespace App\Filament\Resources\PpdbRegistrationResource\Pages;

use App\Filament\Resources\PpdbRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPpdbRegistration extends ViewRecord
{
    protected static string $resource = PpdbRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_card')
                ->label('Cetak Kartu (PDF)')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn (): string => route('ppdb.print-card', $this->record->registration_number))
                ->openUrlInNewTab(),
            Actions\EditAction::make(),
        ];
    }
}

