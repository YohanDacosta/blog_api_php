<?php

namespace App\State\Processor\User;

use App\Dto\Api\UserDto;
use App\DataTransformer\Api\User\UserPostDataTransformer;
use App\State\Processor\User\PersistProcessorInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;

class UserPostProcessor implements PersistProcessorInterface
{
    public function __construct(
        private UserPostDataTransformer $userDataTransformer,
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
