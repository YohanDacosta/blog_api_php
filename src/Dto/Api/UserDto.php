<?php

namespace App\Dto\Api;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Validator\Constraints as AppAssert;

class UserDto
{   
    #[Assert\NotBlank(message: 'The id field should not be blank', groups: ['user:validate'])]
    #[Assert\Uuid(message: 'This is not a valid ID', groups: ['user:validate'])]
    #[Groups(['user:validate'])]
    private Uuid $id;

    #[Assert\NotBlank(message: 'The firstname field should not be blank.', groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private string $firstname;

    #[Assert\NotBlank(message: 'The lastname field should not be blank.', groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private string $lastname;

    #[Assert\NotBlank(message: 'Email should not be blank.', groups: ['user:create'])]
    #[Assert\Email(message: 'The email field {{ value }} is not a valid email.', groups: ['user:create'])]
    #[AppAssert\UniqueEmail(groups: ['user:create', 'user:update'])]
    #[Groups(['user:create', 'user:update'])]
    private string $email;

    #[Assert\NotBlank(message: 'The password field should not be blank.', groups: ['user:create'])]
    #[Assert\Length(min: 8, groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private string $password;

    #[Assert\NotBlank(message: 'The confirm password field should not be blank.', groups: ['user:create'])]
    #[Groups(['user:create', 'user:update'])]
    private string $confirmPassword;

    #[Assert\Callback(groups: ['user:create'])]
    private function validate(ExecutionContextInterface $context): void
    {
        if ($this->password !== $this->confirmPassword) {
            $context->buildViolation('Passwords do not match.')
            ->atPath('confirmPassword')
            ->addViolation();
        }
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): static
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}

