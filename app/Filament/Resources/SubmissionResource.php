<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Filament\Resources\SubmissionResource\RelationManagers;
use App\Models\User;
use App\Models\Submission;
use App\Models\Assignment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
// use App\Filament\Tables\Columns\FileColumn;
use App\Tables\Columns\FileColumn;



class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

   public static function form(Form $form): Form
{
    return $form
        ->schema([
            BelongsToSelect::make('assignment_id')
                ->relationship('assignment', 'title')
                ->options(fn () => Assignment::all()->pluck('title', 'id'))
                ->searchable()
                ->required(),
            BelongsToSelect::make('user_id')
                ->relationship('user', 'name')
                ->options(fn () => User::all()->pluck('name', 'id'))
                ->searchable()
                ->label('Student')
                ->required(),
            TextInput::make('content')->label('Answer (if text)'),
            FileUpload::make('file_path')
                ->label('Uploaded File')
                ->disk('public')
                ->directory('submissions')
                ->preserveFilenames()
                ->downloadable()
                ->openable(),
            TextInput::make('score')->numeric()->label('Grade'),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('assignment.title')->label('Assignment')->searchable(),
            TextColumn::make('user.name')->label('Student')->searchable(),
            TextColumn::make('content')->limit(50)->label('Answer'),
            FileColumn::make('file_path')->label('File')->disk('public')->directory('submissions'),
            TextColumn::make('score')->numeric()->sortable()->label('Grade'),
        ])
        ->headerActions([
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
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }
}
