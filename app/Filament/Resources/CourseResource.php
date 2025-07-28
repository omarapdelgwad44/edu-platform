<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\User;
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
use App\Tables\Columns\FileColumn;



class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
         return $form->schema([
        BelongsToSelect::make('teacher_id')
            ->relationship('teacher', 'name')
            ->label('Teacher')
            ->options(fn () => User::all()->pluck('name', 'id'))
            ->required()
            ->searchable(),
        TextInput::make('title')->required(),
        Textarea::make('description'),
        FileUpload::make('image')->image()->directory('course_images'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 FileColumn::make('image')->label('Image')->disk('public')->directory('course_images'),
                TextColumn::make('title')->searchable(),
                TextColumn::make('teacher.name')->label('Teacher')->searchable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
