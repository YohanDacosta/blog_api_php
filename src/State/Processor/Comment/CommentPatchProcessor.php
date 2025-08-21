<?php

namespace App\State\Processor\Comment;

use App\Entity\Comment; 
use App\Dto\Api\CommentDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ApiPlatform\Metadata\Operation;
use App\DataTransformer\Api\Comment\CommentPatchDataTransformer;

class CommentPatchProcessor implements PersistProcessorInterface
{
    public function __construct(
        private CommentPatchDataTransformer $commentDataTransformer,
        private EntityManagerInterface $entityManager,
    ) {}

    public function process(
        mixed $data, 
        Operation $operation, 
        array $uriVariables = [], 
        array $context = []
    )
    {
        if (!$data instanceof CommentDto) {
            return $data;
        }

        if (!isset($uriVariables['id'])) {
            throw new \InvalidArgumentException('ID is required for patch operation');
        }

        $comment = $this->entityManager->getRepository(Comment::class)
            ->find($uriVariables['id']);

        if (!$comment) {
            throw new NotFoundHttpException('Comment not found');
        }

        $this->commentDataTransformer->transform($data, $comment);

        $this->entityManager->flush();

        return $comment;
    }
}