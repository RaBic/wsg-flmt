<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
// use Closure;
use App\Models\User;
// use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 50;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $modelLabel = 'Nutzer';

    protected static ?string $pluralModelLabel = 'Nutzer';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('roles')
                    ->relationship(
                        'roles',
                        'name',
                        fn (Builder $query) => ! Auth::user()->hasRole('super_admin') ? $query->where('id', '!=', 1) : $query
                    )
                    ->multiple()
                    ->preload(true)
                    ->label('Rolle(n)')
                    ->required()
                    ->columnSpan(2),

                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->confirmed()
                            ->rule(Password::default())
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->dehydrated(false),
                    ])->visible(fn ($livewire) => $livewire instanceof Pages\CreateUser),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('new_password')
                            ->password()
                            ->label('New Password')
                            ->maxLength(255)
                            ->confirmed()
                            ->rule(Password::default())
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('Confirm New Password')
                            ->rule('required', fn ($get) => (bool) $get('new_password'))
                            ->same('new_password')
                            ->dehydrated(false),
                    ])->visible(fn ($livewire) => $livewire instanceof Pages\EditUser),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->label('')->icon('heroicon-s-pencil'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
