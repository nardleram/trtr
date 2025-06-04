<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFilterRequest;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\View\View;

class ArticleFilterController extends Controller
{
    public function consciousness(ArticleFilterRequest $request): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', $request->category);
    }

    public function love(ArticleFilterRequest $request): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', $request->category);
    }

    public function group(ArticleFilterRequest $request): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', $request->category);
    }

    public function money(ArticleFilterRequest $request): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', $request->category);
    }

    public function politics(ArticleFilterRequest $request): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', $request->category);
    }
}
