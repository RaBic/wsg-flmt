<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Inhalte';

    protected static ?int $navigationSort = 90;

    protected static ?string $modelLabel = 'Seite';

    protected static ?string $pluralModelLabel = 'Seiten';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('published_at')->default(null),
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()?->getAuthIdentifier());
                    }),

                Forms\Components\Fieldset::make('')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titel')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                $set('slug', (string) str($state)->slug());
                            })->helperText(fn (Forms\Get $get) => $get('slug')),
                        Forms\Components\RichEditor::make('content')
                            ->label('Inhalt')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                                'strike',
                            ])
                            ->extraAttributes(['class' => 'max-w-2xl'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('published_at')
                    ->label('Status')
                    ->sortable()
                    ->default(false)
                    ->boolean()
                    ->action(
                        Action::make('release')
                            ->modalHeading('Veröffentlichung')
                            ->modalDescription('Tipp: Datum löschen um die Veröffentlichung zu verhindern.')
                            ->form([
                                Forms\Components\DateTimePicker::make('publishing_date')
                                    ->label('Datum, Uhrzeit')
                                    ->nullable()
                                    ->minDate(today())
                                    ->default(fn (Page $record): Carbon => $record->published_at ?? now())
                                    ->format('d.m.Y H:i'),
                            ])
                            ->action(function (array $data, Page $record): void {
                                $record->published_at = $data['publishing_date'];
                                $record->save();
                            })
                            ->modalWidth(MaxWidth::Large)
                    )
                    ->tooltip(
                        function (Page $record): string {
                            $tooltip = 'Klicken um zu veröffentlichen';
                            if ($record->published_at) {
                                $releaseDate = $record->published_at;
                                if ($releaseDate->isFuture()) {
                                    $tooltip = 'Veröffentlichung geplant für ' . $releaseDate->format('d.m.Y H:i');
                                } else {
                                    $tooltip = 'Veröffentlicht am ' . $releaseDate->format('d.m.Y H:i');
                                }
                            }

                            return $tooltip;
                        }
                    )
                    ->color(
                        function (Page $record): string {
                            $color = 'danger';
                            if ($record->published_at) {
                                $releaseDate = Carbon::parse($record->published_at);
                                if ($releaseDate->isFuture()) {
                                    $color = 'warning';
                                } else {
                                    $color = 'success';
                                }
                            }

                            return $color;
                        }
                    )
                    ->icon(
                        function (Page $record): string {
                            $icon = 'heroicon-o-x-circle';
                            if ($record->published_at) {
                                $releaseDate = Carbon::parse($record->published_at);
                                if ($releaseDate->isFuture()) {
                                    $icon = 'heroicon-o-clock';
                                } else {
                                    $icon = 'heroicon-o-check-circle';
                                }
                            }

                            return $icon;
                        }
                    )
                    ->alignment(Alignment::Center)
                    ->grow(),
            ])
            ->filters([
                Filters\TernaryFilter::make('published_at')
                    ->label('sichtbar')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('published_at'),
                        false: fn (Builder $query) => $query->whereNull('published_at'),
                        blank: fn (Builder $query) => $query, // we do not want to filter the query when it is blank.
                    ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PageResource\RelationManagers\BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
