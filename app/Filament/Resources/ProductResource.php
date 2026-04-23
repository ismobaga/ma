<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static string | \UnitEnum | null $navigationGroup = 'Catalogue';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Produit';

    protected static ?string $pluralModelLabel = 'Produits';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Section::make('Informations de base')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->nullable(),
                ])->columns(3),

            Forms\Components\Section::make('Classification')
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Catégorie')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('collection_id')
                        ->label('Collection')
                        ->relationship('collection', 'name')
                        ->nullable()
                        ->searchable()
                        ->preload(),
                ])->columns(2),

            Forms\Components\Section::make('Contenu')
                ->schema([
                    Forms\Components\Textarea::make('short_description')
                        ->label('Description courte')
                        ->rows(2),
                    Forms\Components\RichEditor::make('description')
                        ->label('Description complète'),
                ]),

            Forms\Components\Section::make('Prix')
                ->schema([
                    Forms\Components\TextInput::make('price')
                        ->label('Prix (FCFA)')
                        ->required()
                        ->numeric()
                        ->prefix('FCFA'),
                    Forms\Components\TextInput::make('compare_price')
                        ->label('Prix barré (FCFA)')
                        ->numeric()
                        ->prefix('FCFA'),
                ])->columns(2),

            Forms\Components\Section::make('Statut')
                ->schema([
                    Forms\Components\Select::make('stock_status')
                        ->label('Stock')
                        ->options([
                            'in_stock' => 'En stock',
                            'out_of_stock' => 'Rupture de stock',
                            'preorder' => 'Précommande',
                        ])
                        ->required(),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Produit vedette'),
                    Forms\Components\Toggle::make('is_new')
                        ->label('Nouvelle arrivée'),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Médias')
                ->schema([
                    Forms\Components\FileUpload::make('main_image')
                        ->label('Image principale')
                        ->image()
                        ->directory('products'),
                    Forms\Components\Repeater::make('images')
                        ->label("Galerie d'images")
                        ->relationship()
                        ->schema([
                            Forms\Components\FileUpload::make('path')
                                ->label('Image')
                                ->image()
                                ->directory('products/gallery')
                                ->required(),
                            Forms\Components\TextInput::make('alt_text')
                                ->label('Texte alternatif'),
                            Forms\Components\TextInput::make('sort_order')
                                ->label('Ordre')
                                ->numeric(),
                        ])
                        ->columns(3)
                        ->defaultItems(0),
                ]),

            Forms\Components\Section::make('WhatsApp')
                ->schema([
                    Forms\Components\TextInput::make('origin_note')
                        ->label("Note d'origine"),
                    Forms\Components\Textarea::make('whatsapp_message')
                        ->label('Message WhatsApp personnalisé')
                        ->rows(2)
                        ->placeholder('Laisser vide pour le message par défaut'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable(),
                Tables\Columns\TextColumn::make('collection.name')
                    ->label('Collection')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prix')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 0, ',', ' ').' FCFA'),
                Tables\Columns\TextColumn::make('stock_status')
                    ->label('Stock')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'in_stock' => 'success',
                        'out_of_stock' => 'danger',
                        'preorder' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'in_stock' => 'En stock',
                        'out_of_stock' => 'Rupture',
                        'preorder' => 'Précommande',
                        default => $state,
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Vedette')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Catégorie'),
                Tables\Filters\SelectFilter::make('collection')
                    ->relationship('collection', 'name')
                    ->label('Collection'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Vedette'),
                Tables\Filters\TernaryFilter::make('is_new')
                    ->label('Nouvelle arrivée'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif'),
                Tables\Filters\SelectFilter::make('stock_status')
                    ->options([
                        'in_stock' => 'En stock',
                        'out_of_stock' => 'Rupture de stock',
                        'preorder' => 'Précommande',
                    ])
                    ->label('Statut de stock'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activer')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Désactiver')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                    Tables\Actions\BulkAction::make('mark_featured')
                        ->label('Marquer vedette')
                        ->icon('heroicon-o-star')
                        ->action(fn ($records) => $records->each->update(['is_featured' => true])),
                    Tables\Actions\BulkAction::make('unmark_featured')
                        ->label('Retirer vedette')
                        ->icon('heroicon-o-star')
                        ->action(fn ($records) => $records->each->update(['is_featured' => false])),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
