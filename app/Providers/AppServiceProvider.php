<?php

namespace App\Providers;

use Business\Repository\CategoryRepository;
use Business\Repository\Implementations\CategoryRepositoryImpl;
use Business\Repository\Implementations\PostRepositoryImpl;
use Business\Repository\Implementations\UserRepositoryImpl;
use Business\Repository\Implementations\CommentRepositoryImpl;
use Business\Repository\PostRepository;
use Business\Repository\UserRepository;
use Business\Repository\CommentRepository;
use Business\UseCases\PostInteractor;
use Business\UseCases\Implementations\PostInteractorImpl;
use Business\UseCases\CommentInteractor;
use Business\UseCases\Implementations\CommentInteractorImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostInteractor::class, PostInteractorImpl::class);
        $this->app->bind(CommentInteractor::class, CommentInteractorImpl::class);

        $this->app->bind(CommentRepository::class, CommentRepositoryImpl::class);
        $this->app->bind(PostRepository::class, PostRepositoryImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
