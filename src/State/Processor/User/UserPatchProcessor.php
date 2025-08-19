<?php

namespace App\State\Processor\User;

use App\Entity\User; 
use App\Dto\Api\UserDto;
use App\DataTransformer\Api\UserPatchDataTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ApiPlatform\Metadata\Operation;

class UserPatchProcessor implements PersistProcessorInterface
{
    public function __construct(
        private UserPatchDataTransformer $userDataTransformer,
        private EntityManagerInterface $entityManager,
    ) {}

    public function process(
        mixed $data, 
        Operation $operation, 
        array $uriVariables = [], 
        array $context = []
    ): User
    {
        if (!$data instanceof UserDto) {
            return $data;
        }

        if (!isset($uriVariables['id'])) {
            throw new \InvalidArgumentException('ID is required for patch operation');
        }

        $user = $this->entityManager->getRepository(User::class)
            ->find($uriVariables['id']);

        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        $this->userDataTransformer->transform($data, $user);

        $this->entityManager->flush();

        return $user;
    }
}