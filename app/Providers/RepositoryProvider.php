<?php

namespace App\Providers;

use App\Repositories\MySQL\BaseRepository;
use App\Repositories\MySQL\CommentRepository\CommentRepository;
use App\Repositories\MySQL\CommentRepository\InterfaceCommentRepository;
use App\Repositories\MySQL\IBaseRepository;
use App\Repositories\MySQL\PostRepository\InterfacePostRepository;
use App\Repositories\MySQL\PostRepository\PostRepository;
use App\Repositories\MySQL\UnitRepository\UnitRepository;
use App\Repositories\MySQL\UserRepository\InterfaceUserRepository;
use App\Repositories\MySQL\UserRepository\UserRepository;
use App\Repositories\MySQL\VideoRepository\InterfaceVideoRepository;
use App\Repositories\MySQL\VideoRepository\VideoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class,);
        $this->app->bind(InterfaceUserRepository::class, UserRepository::class);
        $this->app->bind(InterfacePostRepository::class, PostRepository::class);
        $this->app->bind(InterfaceVideoRepository::class, VideoRepository::class);
        $this->app->bind(InterfaceCommentRepository::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
