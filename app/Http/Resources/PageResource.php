<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->get('title')->first()->toArray()['title'],
            'slug' => $this->get('slug')->first()->toArray()['slug'],
            'content' => $this->get('content')->first()->toArray()['content'],
            'sort' => $this->sort,
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'image' => $this->image,
            'blocks' => $this->blocks,
        ];
    }
}
