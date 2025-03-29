<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\LaravelSettings\Models\SettingsProperty as Settings;

/**
 * @mixin Settings
 */
class SettingsResource extends JsonResource
{
    public function __construct(Settings $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'group' => $this->group,
            'payload' => (string) str($this->payload)->replace('"', ''),
            'updated_at' => $this->updated_at,
        ];
    }
}
