<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Textarea;





class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                   BelongsToSelect::make('assignment_id')
            ->relationship('assignment', 'title')
            ->required(),
        Textarea::make('question')->required(),
        Textarea::make('options')
            ->label('Options (JSON Array)')
            ->helperText('مثال: ["A", "B", "C", "D"]')
            ->required(),
        TextInput::make('correct_answer')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('assignment.title')->label('Assignment')->searchable(),
                TextColumn::make('question')->limit(50)->searchable(),
                TextColumn::make('options')->label('Options')->limit(100),
                TextColumn::make('correct_answer')->label('Correct Answer'),
            ]);
            // ->prependActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            // ->filters([
            //     //
            // ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
