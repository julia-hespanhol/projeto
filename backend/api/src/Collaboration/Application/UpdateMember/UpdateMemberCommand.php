<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\UpdateMember;


final class UpdateMemberCommand
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $age;
    private $experimentId;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        int $experimentId
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
        $this->experimentId = $experimentId;
    }

    public static function fromHttpRequest(array $input, int $memberId): self
    {
        $command = new self(
            $memberId,
            $input['firstName'],
            $input['lastName'],
            $input['email'],
            (int)$input['age'],
            (int)$input['experimentId']

        );

        return $command;
    }

    public function id(): int
    {
        return $this->id;
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
