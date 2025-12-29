<?php

namespace App\Filament\Resources\BrandingImageResource\Pages;

use App\Filament\Resources\BrandingImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrandingImage extends EditRecord
{
    protected static string $resource = BrandingImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
