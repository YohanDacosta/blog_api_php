<?php

namespace App\Validator\Constraints;

use App\Repository\UserRepository;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(private UserRepository $userRepository) {}

    public function validate($value, Constraint $constraint) 
    {
        ### To obtain all the attributes of the DTO
        $dto = $this->context->getObject();
        $userByEmail = $this->userRepository->findOneBy(['email' => $value]);
        
        if ($userByEmail && $userByEmail->getEmail() == $dto->getEmail()) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
        }
    }
}