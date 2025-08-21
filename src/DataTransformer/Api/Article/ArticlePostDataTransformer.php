<?php

namespace App\DataTransformer\Api\Article;

use App\Dto\Api\ArticleDto;
use App\Entity\Article;

class ArticlePostDataTransformer
{
    public function transform(ArticleDto $data): Article
    {
        $article = new Article();
        $article->setTitle($data->getTitle());
        $article->setContent($data->getContent());
        $article->setAuthor($data->getAuthor());

        return $article;
    }
}