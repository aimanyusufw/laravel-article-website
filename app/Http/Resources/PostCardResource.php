<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'score' => (float) $this->score,
            'published_at' => [
                'date_time' => $this->published_at,
                'date' => $this->published_at?->format('M d, Y'),
                'relative' => $this->published_at?->diffForHumans(),
            ],
            'read_time' => $this->readTime(),
            'banner' => [
                'path' => $this->banner,
                'url' => $this->banner_url,
            ],
            'author' => [
                'name' => $this->author->name,
                'email' => $this->author->email,
                'position' => $this->author->position,
            ],
            'category' => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ],
        ];
    }
}
