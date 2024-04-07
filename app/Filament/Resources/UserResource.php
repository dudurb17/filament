<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Collection;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->description('Update the user\s information')
                    ->icon('heroicon-o-clock')
                    // ->aside()
                    ->collapsed()
                    ->schema([
                    Forms\Components\TextInput::make('name')
                        ->autofocus()
                        ->required()
                        ->placeholder('Informe o nome'),
                    Forms\Components\FileUpload::make('avatar')
                        ->image(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                    Forms\Components\Toggle::make('active')
                    ]),
                Forms\Components\Section::make('Security Information')
                ->description('Update the user\s security information')
                ->icon('heroicon-o-lock-closed')
                // ->aside()
                ->collapsed()
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->confirmed(),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->label('Confirm Password')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->circular()->label('Imagem'),
                Tables\Columns\TextColumn::make("name")
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make("email")
                ->searchable()
                ->sortable(),
                // Tables\Columns\IconColumn::make('active')
                // ->boolean()
                Tables\Columns\ToggleColumn::make('active')->label('Edit Active')
                 ])
            ->filters([
                // Tables\Filters\SelectFilter::make('active')
                // ->options([
                //     'all' => 'All',
                //     'active' => 'Active',
                //     'inactive' => 'Inactive',
                // ])

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('EditAction')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-circle')
                    ->action(fn(Collection $records)=> $records->each->update(['active'=>false]))
                    ->after(fn()=>Notification::make()
                    ->title('saved successfully')
                    ->success()
                    ->send()),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}