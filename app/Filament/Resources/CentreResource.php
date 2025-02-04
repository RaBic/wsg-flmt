<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentreResource\Pages;
use App\Models\Centre;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;

class CentreResource extends Resource
{
    use Translatable;

    protected static ?string $model = Centre::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Studien';

    protected static ?int $navigationSort = 40;

    protected static ?string $modelLabel = 'Studiezentrum';

    protected static ?string $pluralModelLabel = 'Studienzentren';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()->getAuthIdentifier());
                    }),
                Forms\Components\Hidden::make('geohelper')
                    ->afterStateHydrated(function (?Centre $centre, Forms\Components\Hidden $component) {
                        if (! $centre || ! $centre->geocode) {
                            $geohelper = 'z.B.: Fliethstraße 112-114, 41061 Mönchengladbach';
                        } else {
                            $geocode = json_decode($centre->geocode, true);
                            $geohelper = $geocode['lat'] . ', ' . $geocode['lng'];
                        }

                        $component->state($geohelper);
                    }),

                Forms\Components\Fieldset::make('Zentrum')
                    ->schema([
                        Forms\Components\TextInput::make('centre')
                            ->label('Institution')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('unit')
                            ->label('Abteilung')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('Adresse')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->helperText(fn (Forms\Get $get) => $get('geohelper')),
                    ]),
                Forms\Components\Fieldset::make('Projektleitung')
                    ->schema([
                        Forms\Components\TextInput::make('leader')
                            ->label('Name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('leader_position')
                            ->label('Position')
                            ->maxLength(255),
                    ]),
                Forms\Components\Fieldset::make('Details')
                    ->schema([
                        Forms\Components\TextArea::make('excerpt')
                            ->label('Kutzbeschreibung'),
                        Forms\Components\Select::make('studies')
                            ->label('Studien')
                            ->placeholder('Studien wählen')
                            ->relationship(titleAttribute: 'shortcode')
                            ->multiple()
                            ->preload(),
                    ]),
                Forms\Components\Fieldset::make('Kontakt')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Institution || Ort')
            ->columns([
                Tables\Columns\TextColumn::make('centre')
                    ->label('Institution')
                    ->searchable(),
                Tables\Columns\TextColumn::make('geocode')
                    ->label('Ort')
                    ->searchable()
                    ->formatStateUsing(function (string $state): string {
                        $geocode = json_decode($state, true);
                        $components = collect($geocode['address_components']);
                        $state = $components->filter(
                            fn (array $component) => $component['types'][0] === 'administrative_area_level_1'
                        )->first();
                        $city = $components->filter(
                            fn (array $component) => $component['types'][0] === 'locality'
                        )->first();

                        return $city['long_name'] . ', ' . $state['short_name'];
                    }),
                Tables\Columns\TextColumn::make('studies_list')
                    ->label('Studien')
                    ->state(function (Centre $centre): string {
                        $centre->loadMissing('studies');

                        return $centre->studies->pluck('shortcode')->implode(', ');
                    })
                    ->placeholder('Keine Studien.'),
            ])
            ->filters([
                Filters\SelectFilter::make('studies')
                    ->relationship('studies', 'shortcode')
                    ->label('Studie'),
                QueryBuilder::make()
                    ->constraints([
                        TextConstraint::make('geocode')
                            ->label('Location'),
                    ]),
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
            // ...
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCentres::route('/'),
            'create' => Pages\CreateCentre::route('/create'),
            'edit' => Pages\EditCentre::route('/{record}/edit'),
        ];
    }
}
