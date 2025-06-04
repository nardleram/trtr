<?php

namespace App\Http\Controllers;

use Exception;
use App\Enums\UserRole;
use App\Models\Article;
use Illuminate\View\View;
use App\Exceptions\ArticleException;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;
use App\DataTransferObjects\ArticleDto;
use App\Services\Articles\ArticleService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $service
    ) {}

    public function index(): View
    {
        SEOMeta::setTitle('Articles');

        return view('articles.index')->with('category', '');
    }

    public function create(): View
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        if ( auth()->user()->role_id !== UserRole::Admin->value || 
             auth()->user()->role_id !== UserRole::Author->value ) {
            abort(401, 'You are not authorised to perform this action.');
        }

        $this->service->store(
            ArticleDto::fromRequest($request)
        );

        return redirect()->route('articles.index')->with('category', '');
    }

    public function show($slug): View
    {
        try {
            $article = Article::where('slug', $slug)->firstorfail();
        } catch (Exception $e) {
            throw ArticleException::articleNotFound();
        }

        SEOMeta::setTitle($article->title);
        SEOMeta::setDescription($article->seo);
        SEOMeta::setKeywords($article->keywords);

        OpenGraph::setDescription($article->seo);
        OpenGraph::setTitle($article->title);
        OpenGraph::addImage(env('APP_URL') . '/' . $article->main_image);
        OpenGraph::setUrl(route('articles.show', $article->slug));
        OpenGraph::addProperty('type', 'article');

        return view('articles.show')->with([
            'article' => $this->service->show($article->id, 'App\Models\Article')
        ]);
    }

    public function edit(Article $article): View
    {
        if (!$article->user_id !== auth()->id()) {
            abort(401, 'You are not authorised to perform this action.');
        }

        return view('articles.edit')->with(['article' => $article]);
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        if ($article->user_id !== auth()->id()) {
            abort(401, 'You are not authorised to perform this action.');
        }

        $article = $this->service->update(
            $article,
            ArticleDto::fromRequest($request)
        );

        return redirect()->route('articles.show', $article);
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ( auth()->user()->role_id === UserRole::Admin->value || $article->user_id === auth()->id() ) {
            $article->delete();
        } else {
            abort(401, 'You are not authorised to perform this action.');
        }
        

        return redirect()->route('articles.index');
    }
}
