<?php

namespace App\DataTransformer\Api\Article;

use App\Entity\Article;
use App\Dto\Api\ArticleDto;

class ArticlePatchDataTransformer
{
    public function transform(ArticleDto $data, Article $article)  
    {

        if($data && $data->getTitle() != null) {
            $article->setTitle($data->getTitle());
        } 

        if($data && $data->getContent() != null) {
            $article->setContent($data->getContent());
        } 

        return $article;
    }
}