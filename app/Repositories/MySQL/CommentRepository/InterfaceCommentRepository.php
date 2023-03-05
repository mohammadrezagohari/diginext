<?php

namespace App\Repositories\MySQL\CommentRepository;

use App\Repositories\MySQL\IBaseRepository;

interface InterfaceCommentRepository extends IBaseRepository
{
    public function storePostComment($post,$data);
    public function storeVideoComment($video,$data);
}
