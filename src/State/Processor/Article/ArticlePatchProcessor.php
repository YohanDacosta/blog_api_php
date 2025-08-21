<?php

namespace App\State\Processor\Article;

use App\Entity\Article; 
use App\Dto\Api\ArticleDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ApiPlatform\Metadata\Operation;
use App\DataTransformer\Api\Article\ArticlePatchDataTransformer;

class ArticlePatchProcessor implements PersistProcessorInterface
{
    public function __construct(
        private ArticlePatchDataTransformer $articleDataTransformer,
        private EntityManagerInterface $entityManager,
    ) {}

    public function process(
        mixed $data, 
        Operation $operation, 
        array $uriVariables = [], 
        array $context = []
    )
    {
        if (!$data instanceof ArticleDto) {
            return $data;
        }

        if (!isset($uriVariables['id'])) {
            throw new \InvalidArgumentException('ID is required for patch operation');
        }

        $article = $this->entityManager->getRepository(Article::class)
            ->find($uriVariables['id']);

        if (!$article) {
            throw new NotFoundHttpException('Article not found');
        }

        $this->articleDataTransformer->transform($data, $article);

        $this->entityManager->flush();

        return $article;
    }
}