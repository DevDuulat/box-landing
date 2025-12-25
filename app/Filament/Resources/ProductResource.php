<?php

namespace App\Filament\Resources;

use App\Enums\CardboardType;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Основная информация')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Название товара')
                                ->required(),
                            Forms\Components\Select::make('category_id')
                                ->label('Категория')
                                ->relationship('category', 'name')
                                ->preload()
                                ->required(),
                        ])->columns(2),

                    Forms\Components\Section::make('Конфигурация типов картона')
                        ->description('Добавьте характеристики для Микро, Трехслойного или Пятислойного картона')
                        ->schema([
                            Forms\Components\Repeater::make('specs')
                                ->label('Типы картона для этого товара')
                                ->schema([
                                    Forms\Components\Select::make('type')
                                        ->label('Тип')
                                        ->options(CardboardType::class)
                                        ->required()
                                        ->live(),

                                    Forms\Components\Select::make('profiles')
                                        ->label('Профили')
                                        ->multiple()
                                        ->options(fn (Forms\Get $get): array => match ($get('type')) {
                                            '1', 1 => ['E' => 'E'],
                                            '2', 2 => ['B' => 'B', 'C' => 'C'],
                                            '3', 3 => ['BC' => 'BC', 'CE' => 'CE'],
                                            default => [],
                                        })->required(),

                                    Forms\Components\TagsInput::make('grades')
                                        ->label('Марки')
                                        ->placeholder('Т-21...')
                                        ->required(),
                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->reorderable(true)
                                ->addActionLabel('Добавить еще один тип'),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Общие свойства')
                        ->schema([
                            Forms\Components\TextInput::make('color_type')->label('Цвет')->default('Белый/Бурый'),
                            Forms\Components\TextInput::make('print_colors_count')->label('Печать')->numeric()->default(4),
                            Forms\Components\TextInput::make('dimensions')->label('Размер')->default('По требованию'),
                            Forms\Components\Toggle::make('complies_with_gost_fefco')->label('ГОСТ/FEFCO')->default(true),
                        ]),

                    Forms\Components\Section::make('Изображения')
                        ->schema([
                            Forms\Components\FileUpload::make('photo')->label('Главное')->image(),
                            Forms\Components\FileUpload::make('photo_brown')->label('Бурый')->image(),
                            Forms\Components\FileUpload::make('photo_white')->label('Белый')->image(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->label('Фото'),
                Tables\Columns\TextColumn::make('name')->searchable(),

                Tables\Columns\IconColumn::make('complies_with_gost_fefco')->label('ГОСТ')->boolean(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}