<?php

namespace App\Filament\Concerns;

use App\Models\Page;
use App\Models\Post;
use App\Models\Study;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Stringable;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Str;
use Throwable;

trait HasBlockFormTrait
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                        $component->state(Filament::auth()->user()?->getAuthIdentifier());
                    }),

                Forms\Components\TextInput::make('title')
                    ->label('Titel')
                    ->required(),

                Forms\Components\Repeater::make('image')
                    ->label(null)
                    ->relationship('image')
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                                $component->state(Filament::auth()->user()?->getAuthIdentifier());
                            }),
                        Forms\Components\Hidden::make('purpose')
                            ->afterStateHydrated(function (Forms\Components\Hidden $component) {
                                $component->state('image');
                            }),
                        Forms\Components\FileUpload::make('path')
                            ->label(null)
                            ->image()
                            ->directory(
                                function (RelationManager $livewire): string {
                                    $class = Str::of(get_class($livewire->getOwnerRecord()))
                                        ->replace('App\\Models\\', '')
                                        ->slug();
                                    $slug = $livewire->getOwnerRecord()->slug ?? date('Ymd');

                                    return "{$class}/{$slug}/{$this->activeLocale}";
                                }
                            )
                            ->imagePreviewHeight('250')
                            ->maxSize(8192)
                            ->getUploadedFileNameForStorageUsing(
                                function (TemporaryUploadedFile $file): string {
                                    $fullfilename = (string) $file->getClientOriginalName();
                                    $point = mb_strrpos($fullfilename, '.') ?: mb_strlen($fullfilename);
                                    $filename = mb_substr($fullfilename, 0, $point);
                                    $extension = mb_substr($fullfilename, $point);

                                    return (string) str($filename)
                                        ->slug()
                                        ->append('-' . strval(time()) . $extension);
                                }
                            ),
                    ])
                    ->defaultItems(0)
                    ->maxItems(1)
                    ->itemLabel(
                        function (array $state, RelationManager $livewire): ?Stringable {
                            $className = $livewire->getOwnerRecord()::class;
                            $classSlug = Str::of($className)
                                ->replace('App\\Models\\', '')
                                ->slug();
                            /** @var Page | Post | Study $ownerRecord */
                            $ownerRecord = $livewire->getOwnerRecord();
                            // slug is not necessarily translatable:
                            try {
                                $modelSlug = $ownerRecord->getTranslations('slug');
                                $slug = $modelSlug[$this->activeLocale] ?? reset($modelSlug);
                            } catch (Throwable $e) {
                                $slug = $ownerRecord->slug;
                            }

                            if (empty($state['path'])) {
                                return null;
                            }

                            // reset() gives you the first value of the array
                            return str((string) reset($state['path']))
                                ->replace($classSlug . '/', '')
                                ->replace($slug . '/', '');
                        }
                    )
                    ->addActionLabel('+ Bild'),

                Forms\Components\RichEditor::make('content')
                    ->label('Inhalt')
                    ->required()
                    ->disableToolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'codeBlock',
                        'h2',
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
