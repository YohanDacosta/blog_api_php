<?php

namespace App\DataTransformer\Api;

use App\Entity\User;
use App\Dto\Api\UserDto;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Validator\ValidatorInterface;

class UserPostDataTransformer
{
    public function __construct(
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function transform(UserDto $data): User
    {
        $user = new User();
        $user->setFirstname($data->getFirstname());
        $user->setLastname($data->getLastname());
        $user->setEmail($data->getEmail());
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $data->getPassword()));

        return $user;
    }
}