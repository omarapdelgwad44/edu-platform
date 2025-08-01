<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
 return $form->schema([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
        Select::make('role')
            ->options([
                'teacher' => 'Teacher',
                'student' => 'Student',
            ])
            ->required(),
        TextInput::make('password')
            ->password()
            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
            ->required(fn (string $context) => $context === 'create'),
    ]);    }

    public static function table(Table $table): Table
    {
         return $table->columns([
        TextColumn::make('name')->searchable(),
        TextColumn::make('email')->searchable(),
        TextColumn::make('role')->badge(),
    ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
