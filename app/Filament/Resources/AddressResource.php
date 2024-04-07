<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Address Information')
                    ->description('Update the address information')
                    ->icon('heroicon-o-clock')
                    // ->aside()
                    ->collapsed()
                    ->schema([
                    Forms\Components\TextInput::make('name')
                        ->autofocus()
                        ->required()
                        ->placeholder('Informe o nome'),
                   Forms\Components\Select::make('userId')
                        ->label(__('usuario'))
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->columnSpan(2),
                    Forms\Components\TextInput::make('street')
                        ->required()
                        ->placeholder('Informe o rua'),
                    Forms\Components\TextInput::make('number')
                        ->required()
                        ->placeholder('Informe o número'),
                    Forms\Components\TextInput::make('neighborhood')
                        ->required()
                        ->placeholder('Informe o bairro'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make("user.name")
                ->numeric()
                ->sortable()
                ->label('Nome do usurio'),
                Tables\Columns\TextColumn::make("street"),
                Tables\Columns\TextColumn::make("number"),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'view' => Pages\ViewAddress::route('/{record}'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}