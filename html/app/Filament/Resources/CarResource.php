<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('plate')
                    ->required()
                    ->maxLength(7)
                    ->minLength(5),
                TextInput::make('price_per_day')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Select::make('fuel_type')
                    ->required()
                    ->options([
                        'gasoline' => 'Gasolina',
                        'diesel' => 'Diésel',
                        'electric' => 'Eléctrico',
                        'hybrid' => 'Híbrido',
                    ]),
                Select::make('transmission')
                    ->required()
                    ->options([
                        'manual' => 'Manual',
                        'automatic' => 'Automatic',
                    ]),
                TextInput::make('doors_number')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(7),
                Toggle::make('free_cancelation')
                    ->label("Cancelación gratuita"),
                Select::make('category_id')
                    ->required()
                    ->options(Category::pluck('category_name', 'category_id')),
                TextInput::make('bag_space')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(15),
                TextInput::make('min_age')
                    ->required()
                    ->numeric(),
                FileUpload::make('image')
                    ->required()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plate'),
                TextColumn::make('model')
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
