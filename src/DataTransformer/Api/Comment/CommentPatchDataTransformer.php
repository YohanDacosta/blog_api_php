<?php

namespace App\DataTransformer\Api\Comment;

use App\Entity\Comment;
use App\Dto\Api\CommentDto;

class CommentPatchDataTransformer
{
    public function transform(CommentDto $data, Comment $comment)  
    {

        if($data && $data->getContent() != null) {
            $comment->setContent($data->getContent());
        } 

        return $comment;
    }
}