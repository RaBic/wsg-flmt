<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use App\Models\Unit;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class TeamResource extends Resource
{
    use Translatable;

    protected static ?string $model = Team::class;

    protected static ?string $navigationGroup = 'Unternehmen';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Mitarbeiter';

    protected static ?string $pluralModelLabel = 'Mitarbeiter';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('published')->default(false),
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()->getAuthIdentifier());
                    }),

                Forms\Components\Split::make([
                    Forms\Components\Section::make([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                $set('slug', (string) str($state)->slug());
                            })->helperText(fn (Forms\Get $get) => $get('slug')),

                        Forms\Components\TextInput::make('title')
                            ->label('Position')
                            ->maxLength(100),

                        Forms\Components\Select::make('unit_id')
                            ->native(false)
                            ->label('Abteilung')
                            ->placeholder('Abteilung auswahlen')
                            ->options(Unit::all()->pluck('name', 'id'))
                            ->required()
                            ->selectablePlaceholder(false),
                    ]),

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
                                    $component->state('portrait');
                                }),
                            Forms\Components\FileUpload::make('path')
                                ->label(false)
                                ->image()
                                ->directory(
                                    function (Forms\Get $get): string {
                                        $slug = $get('../../slug') ?? date('Ymd');

                                        return "team/{$slug}";
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
                                    ->replace('team/', '')
                                    ->replace($get('slug') . '/', '') : null;

                                return $label;
                            }
                        )
                        ->addActionLabel('+ Bild'),
                ])
                    ->from('md')
                    ->columnSpanFull(),

                Forms\Components\TextArea::make('excerpt')
                    ->label('Kurzbeschreibung')
                    ->rows(6)
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->label('Vita')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'codeBlock',
                        'strike',
                    ]),

                Forms\Components\TextInput::make('email')
                    ->label('E-Mail-Adresse')
                    ->email()
                    ->maxLength(100),

                Forms\Components\TextInput::make('phone')
                    ->label('Telefonnummer')
                    ->tel()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('sort', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_preview')
                    ->label('')
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->height(48)
                    ->state(function (Team $record): string {
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
                Tables\Columns\TextColumn::make('name')
                    ->label(false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit')
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->boolean()
                    ->label('sichtbar')
                    ->sortable()
                    ->action(
                        Action::make('select')
                            // ->requiresConfirmation()
                            ->action(function (Team $record): void {
                                $record->published = ! $record->published;
                                $record->save();
                                /* $this->dispatchBrowserEvent('select-post', [
                                    'post' => $record->getKey(),
                                ]); */
                            }),
                    )
                    ->tooltip('Status umschalten')
                    ->alignment(Alignment::Center)
                    ->grow(),
            ])
            ->filters([
                Filters\SelectFilter::make('unit_id')
                    ->options(Unit::all()->pluck('name', 'id'))
                    ->label('Abteilung'),
                Filters\TernaryFilter::make('published')
                    ->label('sichtbar'),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
