<?php

namespace App\Filament\Resources;

use App\Enums\PostType;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Inhalte';

    protected static ?int $navigationSort = 50;

    protected static ?string $modelLabel = 'Beitrag';

    protected static ?string $pluralModelLabel = 'Beiträge';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $postTypes = PostType::types();
        $postTypeOptions = PostType::toSelectOptions();

        return $form
            ->schema([
                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('published_at')->default(null),
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()->getAuthIdentifier());
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

                        Forms\Components\Select::make('type')
                            ->native(false)
                            ->label('Thema')
                            ->required()
                            ->placeholder('wählen Sie das Thema')
                            ->options($postTypeOptions)
                            ->in($postTypes)
                            ->required()
                            ->selectablePlaceholder(false),

                        Forms\Components\RichEditor::make('content')
                            ->label('Inhalt')
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'codeBlock',
                                'strike',
                            ])
                            ->extraAttributes(['class' => 'max-w-2xl'])
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('image')
                            ->label(false)
                            ->hint('Reihenfolge: von links nach rechts, von oben nach unten')
                            ->relationship('image')
                            ->defaultItems(0)
                            ->maxItems(2)
                            ->schema([
                                Forms\Components\Hidden::make('user_id')
                                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                                        $component->state(Filament::auth()->user()->getAuthIdentifier());
                                    }),
                                Forms\Components\Hidden::make('purpose')
                                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                                        $component->state('image');
                                    }),
                                Forms\Components\FileUpload::make('path')
                                    ->label(false)
                                    ->image()
                                    ->directory(
                                        function (Forms\Get $get): string {
                                            $slug = $get('../../slug') ?? date('Ymd');

                                            return "post/{$slug}";
                                        }
                                    )
                                    ->imagePreviewHeight('250')
                                    ->maxSize(8192)
                                    ->getUploadedFileNameForStorageUsing(
                                        function (TemporaryUploadedFile $file): string {
                                            $fullfilename = (string) $file->getClientOriginalName();
                                            $point = mb_strrpos($fullfilename, '.');
                                            $filename = mb_substr($fullfilename, 0, $point);
                                            $extension = mb_substr($fullfilename, $point);

                                            return (string) str($filename)
                                                ->slug()
                                                ->append('-' . strval(time()) . $extension);
                                        }
                                    ),
                            ])
                            ->itemLabel(
                                function (array $state, Forms\Get $get): ?string {
                                    $label = $state['path'] ? (string) str(collect($state['path'])
                                        ->first())
                                        ->replace('post/', '')
                                        ->replace($get('slug') . '/', '') : null;

                                    return $label;
                                }
                            )
                            ->addActionLabel('+ Bild')
                            ->grid(['lg' => 2])
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Veröffentlichung')
                    ->default(new Carbon('1970-01-01'))
                    // ->dateTime('d.m.Y H:i')
                    ->formatStateUsing(
                        fn (Carbon $state): string => $state->year > 1970 ? $state->format('d.m.Y H:i') : ' '
                    )
                    ->action(
                        Action::make('release')
                            ->modalHeading('Veröffentlichung')
                            ->modalDescription('Tipp: Datum löschen um die Veröffentlichung zu verhindern.')
                            ->form([
                                Forms\Components\DateTimePicker::make('publishing_date')
                                    ->label('Datum, Uhrzeit')
                                    ->nullable()
                                    // ->minDate(today())
                                    ->default(fn (Post $record): Carbon => $record->published_at ?? now())
                                    ->format('d.m.Y H:i'),
                            ])
                            ->action(function (array $data, Post $record): void {
                                $record->published_at = $data['publishing_date'];
                                $record->save();
                            })
                            ->modalWidth(MaxWidth::Large)
                    )
                    ->tooltip(
                        function (Post $record): string {
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
                        function (Post $record): string {
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
                        function (Post $record): string {
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
                Filters\SelectFilter::make('type')
                    ->options(PostType::toSelectOptions())
                    ->label('Thema'),
                Filters\TernaryFilter::make('published_at')
                    ->label('sichtbar')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('published_at'),
                        false: fn (Builder $query) => $query->whereNull('published_at'),
                        blank: fn (Builder $query) => $query, // we do not want to filter the query when it is blank.
                    ),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
