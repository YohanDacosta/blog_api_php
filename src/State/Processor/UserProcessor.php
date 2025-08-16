<?php

namespace App\State\Processor;

use App\Dto\Api\UserDto;
use App\DataTransformer\Api\UserDataTransformer;
use App\State\Processor\PersistProcessorInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class UserProcessor implements PersistProcessorInterface
{
    public function __construct(
        private UserDataTransformer $userDataTransformer,
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

        if (!$data instanceof UserDto) {
            return $data;
        }
        $user = $this->userDataTransformer->transform($data);

    	$this->persistProcessor->process($user, $operation, $uriVariables, $context);

        return $user;
    }
}
