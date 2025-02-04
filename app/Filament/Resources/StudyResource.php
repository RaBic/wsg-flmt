<?php

namespace App\Filament\Resources;

use App\Enums\StudyType;
use App\Filament\Resources\StudyResource\Pages;
use App\Models\Study;
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
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class StudyResource extends Resource
{
    use Translatable;

    protected static ?string $model = Study::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Studien';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Studie';

    protected static ?string $pluralModelLabel = 'Studien';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $studyTypes = StudyType::types();
        $studyTypeOptions = StudyType::toSelectOptions();

        return $form
            ->schema([
                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('published_at')->default(null),
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()->getAuthIdentifier());
                    }),

                Forms\Components\TextInput::make('shortcode')
                    ->label('Titel (Code)')
                    ->required()
                    ->maxLength(32)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        $set('slug', (string) str($state)->slug());
                    })->helperText(fn (Forms\Get $get) => $get('slug')),

                Forms\Components\Select::make('type')
                    ->native(false)
                    ->label('Stadium')
                    ->required()
                    ->placeholder('wählen Sie eine Option')
                    ->options($studyTypeOptions)
                    ->in($studyTypes)
                    ->required()
                    ->selectablePlaceholder(false),

                Forms\Components\TextArea::make('title')
                    ->label('Bezeichnung')
                    ->rows(6)
                    ->required(),

                Forms\Components\Repeater::make('image')
                    ->label(false)
                    ->relationship('image')
                    ->defaultItems(1)
                    ->addable(false)
                    ->deletable(false)
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

                                    return "study/{$slug}/logo";
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
                                ->replace('study/', '')
                                ->replace('logo/', '')
                                ->replace($get('slug') . '/', '') : null;

                            return $label;
                        }
                    )
                    ->addActionLabel('+ Bild'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->defaultGroup('type')
            ->reorderable('sort')
            ->defaultSort('sort', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_preview')
                    ->label('')
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->height(48)
                    ->state(function (Study $record): string {
                        $record->load('image');
                        if (empty($record->image)) {
                            return 'thumb/dummy.png';
                        }
                        if (! file_exists(storage_path('app/public/thumb'))) {
                            @mkdir(storage_path('app/public/thumb'), 0755, true);
                        }
                        $tree = '';
                        str($record->image->path)
                            ->explode('/')
                            ->slice(0, -1)
                            ->each(function ($dir) use (&$tree) {
                                $tree .= '/' . $dir;
                                if (! file_exists(storage_path('app/public/thumb' . $tree))) {
                                    @mkdir(storage_path('app/public/thumb' . $tree), 0755, true);
                                }
                            });
                        if (! file_exists(storage_path('app/public/thumb/' . $record->image->path))) {
                            $image = Image::load(storage_path('app/public/' . $record->image->path));
                            if ($image->getWidth() > 192) {
                                $image->fit(Fit::Crop, 192, 144);
                            }
                            $image->save(storage_path('app/public/thumb/' . $record->image->path));
                        }

                        return 'thumb/' . $record->image->path;
                    }),
                Tables\Columns\TextColumn::make('shortcode')
                    ->label('Studie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Stadium')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => StudyType::toSelectOptions()[$state]),
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
                                    ->default(fn (Study $record): Carbon => $record->published_at ?? now())
                                    ->format('d.m.Y H:i'),
                            ])
                            ->action(function (array $data, Study $record): void {
                                $record->published_at = $data['publishing_date'];
                                $record->save();
                            })
                            ->modalWidth(MaxWidth::Large)
                    )
                    ->tooltip(
                        function (Study $record): string {
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
                        function (Study $record): string {
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
                        function (Study $record): string {
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
                    ->options(StudyType::toSelectOptions())
                    ->label('Stadium'),
                Filters\TernaryFilter::make('published_at')
                    ->label('sichtbar')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('published_at'),
                        false: fn (Builder $query) => $query->whereNull('published_at'),
                        blank: fn (Builder $query) => $query, // we do not want to filter the query when it is blank.
                    ),
            ])/*
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]) */;
    }

    public static function getRelations(): array
    {
        return [
            StudyResource\RelationManagers\BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudies::route('/'),
            'create' => Pages\CreateStudy::route('/create'),
            'edit' => Pages\EditStudy::route('/{record}/edit'),
        ];
    }
}
