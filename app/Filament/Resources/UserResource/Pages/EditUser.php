<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

/**
 * @mixin User
 */
class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function beforeSave(): void
    {
        // Check if the new password is set and not empty
        // If so, hash it and assign it to the record's password attribute
        // This will ensure that the password is only updated if a new one is provided
        // Otherwise, the existing password remains unchanged

        if (! is_array($this->data) || ! isset($this->data['new_password']) || ! filled($this->data['new_password'])) {
            return;
        }

        if ($this->record instanceof User) {
            $newPassword = is_string($this->data['new_password']) ? $this->data['new_password'] : null;
            if (! $newPassword) {
                return;
            }
            // Hash the new password and assign it to the record's password attribute
            $this->record->password = Hash::make($newPassword);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
