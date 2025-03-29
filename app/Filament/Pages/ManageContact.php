<?php

namespace App\Filament\Pages;

use App\Settings\CompanyContact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageContact extends SettingsPage
{
    protected static ?string $navigationGroup = 'Unternehmen';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 99;

    protected static ?string $navigationLabel = 'Kontakt';

    protected static string $settings = CompanyContact::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('address')
                    ->label('(Post-)Adresse')
                    ->required()
                    ->autosize(),
                Forms\Components\Textarea::make('workhours')
                    ->label('Erreichbarkeit'),
                Forms\Components\TextInput::make('email')
                    ->label('E-Mail-Adresse')
                    ->required(),
                Forms\Components\TextInput::make('fon')
                    ->label('Telefonnummer')
                    ->required(),
                Forms\Components\TextInput::make('linkedin')
                    ->label('LinkedIn-URL')
                    ->required(),
                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram-URL'),
            ]);
    }
}
