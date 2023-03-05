<?php

namespace App\Repositories\MySQL\VideoRepository;

use App\Models\Video;
use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from IBaseInfoRepository to register the rules
 *********************************************************************************/
class VideoRepository extends BaseRepository implements InterfaceVideoRepository
{
    /***********************
     * @var Video $model
     ***********************/
    protected Video $model;

    /*************************
     * @param Video $model
     * pass our model to the BaseRepository
     *************************/
    public function __construct(Video $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


}
