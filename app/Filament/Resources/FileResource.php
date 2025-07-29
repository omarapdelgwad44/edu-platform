<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use App\Filament\Resources\FileResource\RelationManagers;
use App\Models\File;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\FileUpload;




class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

public static function form(Form $form): Form
{
    return $form->schema([
        BelongsToSelect::make('lesson_id')
            ->relationship('lesson', 'title')
            ->label('Lesson')
            ->options(fn () => Lesson::all()->pluck('title', 'id'))
            ->required()
            ->searchable(),

        TextInput::make('name')
            ->label('File Name')
            ->required(),

        FileUpload::make('file_path')
            ->label('File')
            ->required()
            ->directory('lesson_files')
            ->preserveFilenames()
            ->downloadable()
            ->openable(),
    ]);
}


public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('name')->label('File Name')->searchable(),

        TextColumn::make('lesson.title')
            ->label('Lesson')
            ->sortable()
            ->searchable(),

        TextColumn::make('file_path')
            ->label('File Path')
            ->wrap()
            ->copyable(),
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
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }
}
