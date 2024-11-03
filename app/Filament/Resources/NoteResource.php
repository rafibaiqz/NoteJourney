<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\Note;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;


class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = "Catatan";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->required()
                ->placeholder('judul')
                ->maxLength(255)
                ->columnSpan('full'),
                Textarea::make('content')
                ->required()
                ->rows(20)
                ->placeholder('catatan')
                ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('content')->limit(50),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotes::route('/'),
        ];
    }
}
