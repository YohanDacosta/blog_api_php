<?php

namespace App\Dto\Api;

use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleDto
{

    #[Assert\NotBlank(message: 'The title field should not be blank.', groups: ['article:create'])]
    #[Groups(['article:create', 'article:update'])]
    private ?string $title = null;

    #[Assert\NotBlank(message: 'The content field should not be blank.', groups: ['article:create'])]
    #[Groups(['article:create', 'article:update'])]
    private ?string $content = null;

    #[Assert\NotBlank(message: 'The author field should not be blank.', groups: ['article:create'])]
    #[Groups(['article:create'])]
    private ?User $author;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title)
    {
        $this->title = $title;

        return $this;
    }

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
}
