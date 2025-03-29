<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function __construct(Post $resource)
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
            'slug' => $this->getTranslations('slug'),
            'type' => $this->type,
            'content' => $this->getTranslations('content'),
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'image' => $this->image,
            'blocks' => $this->blocks,
        ];
    }
}
