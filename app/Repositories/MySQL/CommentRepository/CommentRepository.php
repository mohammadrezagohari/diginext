<?php

namespace App\Repositories\MySQL\CommentRepository;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from IBaseInfoRepository to register the rules
 *********************************************************************************/
class CommentRepository extends BaseRepository implements InterfaceCommentRepository
{
    /***********************
     * @var Comment $model
     ***********************/
    protected Comment $model;

    /*************************
     * @param Comment $model
     * pass our model to the BaseRepository
     *************************/
    public function __construct(Comment $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storePostComment($post, $data)
    {
        return $post->comments()->create($data);
    }

    public function storeVideoComment($video, $data)
    {
        return $video->comments()->create($data);
    }


}
