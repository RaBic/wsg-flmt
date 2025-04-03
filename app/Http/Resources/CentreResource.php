<?php

namespace App\Http\Resources;

use App\Models\Centre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Centre
 */
class CentreResource extends JsonResource
{
    public function __construct(Centre $resource)
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
        $geocode = $this->geocode ? json_decode($this->geocode, true) : [];

        return [
            'id' => $this->id,
            'centre' => $this->centre,
            'unit' => $this->unit,
            'address' => $this->address,
            'geocode' => $geocode,
            'leader' => $this->leader,
            'leader_position' => $this->getTranslations('leader_position'),
            'excerpt' => count($this->getTranslations('excerpt')) > 0 ? $this->getTranslations('excerpt') : null,
            'url' => $this->url,
            'phone' => $this->phone,
            'email' => $this->email,
            'updated_at' => $this->updated_at,
            'studies' => $this->studies,
        ];
    }
}
