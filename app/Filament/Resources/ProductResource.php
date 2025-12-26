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
    protected static ?string $navigationLabel = 'Продукты';
    protected static ?string $pluralModelLabel = 'Продукты';
    protected static ?string $modelLabel = 'Продукт';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Основная информация')
                        ->schema([
                            // Мультиязычное название
                            Forms\Components\Tabs::make('Translations')
                                ->tabs([
                                    Forms\Components\Tabs\Tab::make('Русский')
                                        ->schema([
                                            Forms\Components\TextInput::make('name.ru')
                                                ->label('Название (RU)')
                                                ->required(fn (string $operation) => $operation === 'create'),
                                        ]),
                                    Forms\Components\Tabs\Tab::make('Кыргызча')
                                        ->schema([
                                            Forms\Components\TextInput::make('name.kg')
                                                ->label('Аталышы (KG)'),
                                        ]),
                                ])->columnSpanFull(),

                            Forms\Components\Select::make('category_id')
                                ->label('Категория')
                                ->relationship('category', 'name->ru') // Отображаем RU название в списке
                                ->preload()
                                ->required(),
                        ])->columns(1),

                    Forms\Components\Section::make('Конфигурация типов картона')
                        ->description('Добавьте характеристики для Микро, Трехслойного или Пятислойного картона')
                        ->schema([
                            Forms\Components\Repeater::make('specs')
                                ->label('Типы картона для этого товара')
                                ->schema([
                                    Forms\Components\Select::make('type')
                                        ->label('Тип')
                                        ->options(CardboardType::class) // Enum будет использовать наш новый метод label()
                                        ->required()
                                        ->live(),

                                    Forms\Components\Select::make('profiles')
                                        ->label('Профили')
                                        ->multiple()
                                        ->options(fn (Forms\Get $get): array => match ((int)$get('type')) {
                                            1 => ['E' => 'E'],
                                            2 => ['B' => 'B', 'C' => 'C'],
                                            3 => ['BC' => 'BC', 'CE' => 'CE'],
                                            default => [],
                                        })->required(),

                                    Forms\Components\TagsInput::make('grades')
                                        ->label('Марки')
                                        ->placeholder('Т-21...')
                                        ->required(),
                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->addActionLabel('Добавить еще один тип'),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Общие свойства (Перевод)')
                        ->schema([
                            Forms\Components\Tabs::make('PropertiesTranslations')
                                ->tabs([
                                    Forms\Components\Tabs\Tab::make('RU')
                                        ->schema([
                                            Forms\Components\TextInput::make('color_type.ru')
                                                ->label('Цвет (RU)')->default('Белый/Бурый'),
                                            Forms\Components\TextInput::make('dimensions.ru')
                                                ->label('Размер (RU)')->default('По требованию'),
                                        ]),
                                    Forms\Components\Tabs\Tab::make('KG')
                                        ->schema([
                                            Forms\Components\TextInput::make('color_type.kg')
                                                ->label('Түсү (KG)')->default('Ак/Күрөң'),
                                            Forms\Components\TextInput::make('dimensions.kg')
                                                ->label('Өлчөмү (KG)')->default('Буйрутма боюнча'),
                                        ]),
                                ]),

                            Forms\Components\TextInput::make('print_colors_count')
                                ->label('Кол-во цветов печати')
                                ->numeric()
                                ->default(4),

                            Forms\Components\Toggle::make('complies_with_gost_fefco')
                                ->label('ГОСТ/FEFCO')
                                ->default(true),
                        ]),

                    Forms\Components\Section::make('Изображения')
                        ->schema([
                            Forms\Components\FileUpload::make('photo')->label('Главное')->image()->directory('products'),
                            Forms\Components\FileUpload::make('photo_brown')->label('Бурый')->image()->directory('products'),
                            Forms\Components\FileUpload::make('photo_white')->label('Белый')->image()->directory('products'),
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