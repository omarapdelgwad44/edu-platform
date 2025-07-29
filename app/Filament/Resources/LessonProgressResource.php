<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonProgressResource\Pages;
use App\Filament\Resources\LessonProgressResource\RelationManagers;
use App\Models\LessonProgress;
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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;



class LessonProgressResource extends Resource
{
    protected static ?string $model = LessonProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    BelongsToSelect::make('user_id')
            ->relationship('user', 'name')
            ->searchable(),
        BelongsToSelect::make('lesson_id')
            ->relationship('lesson', 'title')
            ->options(fn () => Lesson::all()->pluck('title', 'id'))
            ->searchable(),
        Select::make('status')
            ->options([
                'not_started' => 'Not Started',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
            ])
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                               TextColumn::make('lesson.title')->label('Lesson Title'),
            TextColumn::make('user.name')->label('User Name'),
            TextColumn::make('status')->label('Status'),

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
            'index' => Pages\ListLessonProgress::route('/'),
            'create' => Pages\CreateLessonProgress::route('/create'),
            'edit' => Pages\EditLessonProgress::route('/{record}/edit'),
        ];
    }
}
