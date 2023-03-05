<?php

namespace App\Models;

use App\Traits\Models\WithIndexTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,WithIndexTrait;
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    #region relation
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    #endregion
}
