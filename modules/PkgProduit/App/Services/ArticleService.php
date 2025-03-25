<?php

namespace Modules\Blog\App\Services;

use Modules\Blog\Models\Article;

class ArticleService
{
    public function getAllArticles()
    {
        return Article::all();
    }

    public function storeArticle($request)
    {
        $data = $request->only('title', 'content', 'author');
        return Article::create($data);
    }

    public function getArticleById($id)
    {
        return Article::findOrFail($id);
    }

    public function updateArticle($request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->only('title', 'content', 'author'));
        return $article;
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
    }
}
