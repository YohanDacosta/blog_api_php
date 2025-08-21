<?php

namespace App\Dto\Api;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CommentDto
{
    #[Assert\NotBlank(message: 'The content field should not be blank.', groups: ['comment:create'])]
    #[Groups(['comment:create', 'comment:update'])]
    private ?string $content = null;

    #[Assert\NotBlank(message: 'The author field should not be blank.', groups: ['comment:create'])]
    #[Groups(['comment:create'])]
    private ?User $author;

    #[Assert\NotBlank(message: 'The article field should not be blank.', groups: ['comment:create'])]
    #[Groups(['comment:create'])]
    private ?Article $article;

    
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function setContent(?string $content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getAuthor(): ?User 
    {
        return $this->author;
    }
    
    public function setAuthor(?User $author)
    {
        $this->author = $author;
        
        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }
    
    public function setArticle(?Article $article)
    {
        $this->article = $article;
    
        return $this;
    }
}
