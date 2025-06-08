<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'score' => (float) $this->score,
            'status' => $this->status,

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
                'bio' => $this->author->bio,
                'images' => [
                    'profile_picture' => $this->author->profile_picture,
                    'profile_picture_url' => $this->author->profile_picture_url,
                ],
                'socials' => [
                    'github' => $this->author->github_handle,
                    'twitter' => $this->author->twitter_handle,
                    'instagram' => $this->author->instagram_handle,
                ],
            ],

            'category' => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
                'description' => $this->category->description,
                'images' => [
                    'thumbnail' => $this->category->thumbnail,
                    'thumbnail_url' => $this->category->thumbnail_url,
                ],
            ],
            "tags" => TagResource::collection($this->tags),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
