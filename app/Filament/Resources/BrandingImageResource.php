<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandingImageResource\Pages;
use App\Models\BrandingImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BrandingImageResource extends Resource
{
    protected static ?string $model = BrandingImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $pluralModelLabel = 'Слайдер брендинга';
    protected static ?string $modelLabel = 'Слайдер брендинга';
    protected static ?string $navigationLabel = 'Слайдер брендинга';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Изображение слайдера')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->label('Фото')
                            ->image()
                            ->directory('branding')
                            ->imageEditor()
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                // Показываем миниатюру изображения
                Tables\Columns\ImageColumn::make('path')
                    ->label('Изображение')
                    ->square(),



                Tables\Columns\IconColumn::make('is_active')
                    ->label('Статус')
                    ->boolean(),


                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrandingImages::route('/'),
            'create' => Pages\CreateBrandingImage::route('/create'),
            'edit' => Pages\EditBrandingImage::route('/{record}/edit'),
        ];
    }
}