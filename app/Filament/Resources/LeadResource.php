<?php

namespace App\Filament\Resources;

use App\Enums\LeadStatus;
use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationLabel = 'Заявки';
    protected static ?string $pluralModelLabel = 'Заявки';
    protected static ?string $modelLabel = 'Заявку';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о клиенте')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Имя')
                            ->placeholder('Иван Иванов')
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Телефон')
                            ->tel()
                            ->placeholder('+996 (___) __-__-__')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                LeadStatus::NEW->value => LeadStatus::NEW->label(),
                                LeadStatus::PROCESSED->value => LeadStatus::PROCESSED->label(),
                                LeadStatus::CLOSED->value => LeadStatus::CLOSED->label(),
                            ])
                            ->default(LeadStatus::NEW->value)
                            ->required()
                            ->native(false), // Делает выпадающий список красивее
                        Forms\Components\Textarea::make('message')
                            ->label('Сообщение')
                            ->placeholder('Текст обращения...')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),

                // Заменяем TextColumn на SelectColumn для редактирования на месте
                Tables\Columns\SelectColumn::make('status')
                    ->label('Статус')
                    ->options([
                        LeadStatus::NEW->value => LeadStatus::NEW->label(),
                        LeadStatus::PROCESSED->value => LeadStatus::PROCESSED->label(),
                        LeadStatus::CLOSED->value => LeadStatus::CLOSED->label(),
                    ])
                    ->selectablePlaceholder(false)
                    ->rules(['required']),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранные'),
                ]),
            ])
            ->emptyStateHeading('Заявок пока нет')
            ->emptyStateDescription('Все новые обращения появятся в этом списке.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}