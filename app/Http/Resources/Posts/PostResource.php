<?php

namespace App\Http\Resources\Posts;

use App\Http\Resources\Comments\CommentResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*********
 * @mixin Post
 */
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
            'content' => $this->content,
            'username' => $this->User->username,
            'comments' => @count($this->comments) ? $this->comments()->with([
                'User' => function ($query) {
                    $query->select('id', 'username');
                }
            ])->get() : [],
        ];
    }
}
