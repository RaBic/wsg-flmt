<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Team
 */
class TeamResource extends JsonResource
{
    public function __construct(Team $resource)
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
            'slug' => $this->slug,
            'title' => $this->getTranslations('title'),
            'excerpt' => $this->getTranslations('excerpt'),
            'description' => $this->getTranslations('description'),
            'sort' => $this->sort,
            'published' => $this->published,
            'updated_at' => $this->updated_at,
            'image' => $this->image,
            'unit' => $this->unit,
        ];
    }
}
