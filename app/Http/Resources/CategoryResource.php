<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "slug" => $this->slug,
            "banner" => [
                "path" => $this->thumbnail,
                "url" => $this->thumbnail_url,
            ],
            "posts" => PostCardResource::collection($this->whenLoaded('posts')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
