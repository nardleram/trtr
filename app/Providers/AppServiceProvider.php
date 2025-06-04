<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['biases', 'articles.index', 'articles.show'], function ($view) {
            $view->with('articles', Article::with('user', 'comments')->orderBy('created_at')->paginate(12));
        });
    }
}
