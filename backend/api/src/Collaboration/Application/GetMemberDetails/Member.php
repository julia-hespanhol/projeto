<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\GetMemberDetails;

class Member implements \JsonSerializable
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
        $this->experimentid = $experimentId;
    }

    public static function fromPersistence(array $data): self
    {
        return new self(
            (int) $data['ID'],
            $data['FIRST_NAME'],
            $data['LAST_NAME'],
            $data['EMAIL'],
            (int) $data['AGE'],
            (int) $data['EXPERIMENT_ID']
        );
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "lastName" => $this->fullName,
            "email" => $this->email,
            "age" => $this->age,
            "experimentId" => $this->experimentId
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
