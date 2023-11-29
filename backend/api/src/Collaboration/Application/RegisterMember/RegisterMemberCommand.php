<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\RegisterMember;

final class RegisterMemberCommand
{
    private $firstName;
    private $lastName;
    private $email;
    private $age;
    private $experimentId;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        int $experimentId
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
        $this->experimentId = $experimentId;
    }

    public static function fromHttpRequest(array $input): self
    {
        $command = new self(
            $input['firstName'],
            $input['lastName'],
            $input['email'],
            $input['age'],
            $input['experimentId']

        );

        return $command;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function experimentId(): int
    {
        return $this->experimentId;
    }

    public function age(): int
    {
        return $this->age;
    }
}
