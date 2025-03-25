<?php

namespace Modules\Blog\Controllers;

use Modules\Blog\Models\Article;
use Illuminate\Http\Request;
use Modules\Blog\App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return view('Blog::index', compact('articles'));
    }

    public function create()
    {
        return view('Blog::create');
    }

    public function store(Request $request)
    {
    $this->articleService->storeArticle($request);

    $articles = $this->articleService->getAllArticles();

    return view('Blog::index', compact('articles'));
    }

    public function edit($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('Blog::edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $this->articleService->updateArticle($request, $id);
        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);
        return redirect()->route('articles.index');
    }
}
