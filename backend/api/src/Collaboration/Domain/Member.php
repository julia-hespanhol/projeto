<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Domain;

use Glance\Onboarding\Collaboration\Domain\Exception\MemberException;


class Member
{
    
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $age;
    private $experimentId;

    public function __construct(
        IntegerId $id,
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

    public static function fromPersistence(?array $data): self
    {
        if (empty($data)) {
            throw MemberException::memberNotFound();
        }

        return new self(
            IntegerId::fromString($data['ID']),
            $data['FIRST_NAME'],
            $data['LAST_NAME'],
            $data['EMAIL'],
            (int) $data['AGE'],
            (int) $data['EXPERIMENT_ID']
        );
    }

    public static function create(
        IntegerId $id,
        string $firstName,
        string $fullName,
        string $email,
        int $age,
        int $experimentId

    ): self {
        return new self(
            $id,
            $firstName,
            $lastName,
            $email,
            $age,
            $experimentId
        );
    }

    public function id(): IntegerId
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

    public function updateFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function updateLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function updateEmail(string $email): void
    {
        $this->email = $email;
    }

    public function updateExperimentId(int $experimentId): void
    {
        $this->experimentId = $experimentId;
    }

    public function updateAge(int $age): void
    {
        $this->age = $age;
    }

    public function update(string $firstName, string $lastName, string $email, int $age, int $experimentId): void 
    {
        $this->updateFirstName($firstName);
        $this->updateLastName($lastName);
        $this->updateEmail($email);
        $this->updateAge($age);
        $this->updateExperimentId($experimentId);
    }
}
