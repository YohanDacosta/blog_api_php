<?php

namespace App\DataTransformer\Api\User;

use App\Entity\User;
use App\Dto\Api\UserDto;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Validator\ValidatorInterface;

class UserPatchDataTransformer
{
    public function __construct(
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function transform(UserDto $data, User $user)  
    {

        if($data && $data->getFirstname() != null) {
            $user->setFirstname($data->getFirstname());
        } 

        if($data && $data->getLastname() != null) {
            $user->setLastname($data->getLastname());
        } 

        if($data && $data->getEmail() != null) {
            $user->setEmail($data->getEmail());
        } 

        if ($data && $data->getPassword() != null) {
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $data->getPassword()));
        }

        return $user;
    }
}