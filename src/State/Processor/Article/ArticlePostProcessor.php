<?php

namespace App\State\Processor\Article;

use App\Dto\Api\ArticleDto;
use App\DataTransformer\Api\Article\ArticlePostDataTransformer;
use App\State\Processor\Article\PersistProcessorInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class ArticlePostProcessor implements PersistProcessorInterface
{
    public function __construct(
        private ArticlePostDataTransformer $articleDataTransformer,
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
        if (!$data instanceof ArticleDto) {
            return $data;
        }

        $article = $this->articleDataTransformer->transform($data);

    	$this->persistProcessor->process($article, $operation, $uriVariables, $context);

        return $article;
    }
}
