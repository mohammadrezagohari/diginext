<?php

namespace App\Repositories\MySQL\PostRepository;

use App\Models\Post;
use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from IBaseInfoRepository to register the rules
 *********************************************************************************/
class PostRepository extends BaseRepository implements InterfacePostRepository
{
    /***********************
     * @var Post $model
     ***********************/
    protected Post $model;

    /*************************
     * @param Post $model
     * pass our model to the BaseRepository
     *************************/
    public function __construct(Post $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


}
