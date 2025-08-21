<?php

namespace App\State\Processor\Comment;

use App\Dto\Api\CommentDto;
use App\DataTransformer\Api\Comment\CommentPostDataTransformer;
use App\State\Processor\Comment\PersistProcessorInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class CommentPostProcessor implements PersistProcessorInterface
{
    public function __construct(
        private CommentPostDataTransformer $commentDataTransformer,
        private ProcessorInterface $persistProcessor,
    )
    {}

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

        $comment = $this->commentDataTransformer->transform($data);

    	$this->persistProcessor->process($comment, $operation, $uriVariables, $context);

        return $comment;
    }
}
