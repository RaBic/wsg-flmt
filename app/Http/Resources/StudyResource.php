<?php

namespace App\Http\Resources;

use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Study
 */
class StudyResource extends JsonResource
{
    public function __construct(Study $resource)
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
            'title' => $this->getTranslations('title'),
            'slug' => $this->slug,
            'shortcode' => $this->shortcode,
            'type' => $this->type,
            // 'content' => $this->content,
            'sort' => $this->sort,
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'image' => $this->image,
            'blocks' => $this->blocks,
        ];
    }
}
