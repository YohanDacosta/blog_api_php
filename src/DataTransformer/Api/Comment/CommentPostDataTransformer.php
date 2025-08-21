<?php

namespace App\DataTransformer\Api\Comment;

use App\Dto\Api\CommentDto;
use App\Entity\Comment;

class CommentPostDataTransformer
{
    public function transform(CommentDto $data): Comment
    {
        $comment = new Comment();
        $comment->setContent($data->getContent());
        $comment->setArticle($data->getArticle());
        $comment->setAuthor($data->getAuthor());

        return $comment;
    }
}