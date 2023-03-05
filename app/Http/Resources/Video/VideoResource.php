<?php

namespace App\Http\Resources\Video;

use App\Http\Resources\Comments\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'url' => $this->url,
            'comments' => @count($this->comments) ? $this->comments()->with([
                'User' => function ($query) {
                    $query->select('id', 'username');
                }
            ])->get() : [],
            'username' => $this->User->username
        ];
    }
}
