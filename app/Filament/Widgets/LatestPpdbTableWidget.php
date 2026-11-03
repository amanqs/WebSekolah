<?php

namespace App\Filament\Widgets;

use App\Models\PpdbRegistration;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPpdbTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Pendaftar PPDB Online Terbaru';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PpdbRegistration::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('registration_number')
                    ->label('No. Registrasi')
                    ->weight('bold')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Nama Lengkap Calon Siswa')
                    ->searchable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('previous_school_name')
                    ->label('Asal Sekolah')
                    ->limit(25),
                TextColumn::make('status')
                    ->label('Status Seleksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'verified' => 'info',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Terverifikasi',
                        'accepted' => 'Diterima',
                        'rejected' => 'Tidak Lolos',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Waktu Daftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('verify')
                    ->label('Buka Data')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (PpdbRegistration $record): string => url('/admin/ppdb-registrations/' . $record->id . '/edit')),
            ])
            ->paginated(false);
    }
}
