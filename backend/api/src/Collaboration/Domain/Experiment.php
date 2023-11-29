<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Domain;

use Glance\Onboarding\Collaboration\Domain\Exception\ExperimentException;

class Experiment
{
    private $id;
    private $acronym;
    private $fullName;
    private $address;

    public function __construct(
        IntegerId $id,
        string $acronym,
        string $fullName,
        string $address
    ) {
        $this->id = $id;
        $this->acronym = $acronym;
        $this->fullName = $fullName;
        $this->address = $address;
    }

    public static function fromPersistence(?array $data): self
    {
        if (empty($data)) {
            throw ExperimentException::experimentNotFound();
        }

        return new self(
            IntegerId::fromString($data['ID']),
            $data['ACRONYM'],
            $data['FULL_NAME'],
            $data['ADDRESS']
        );
    }

    public static function create(
        IntegerId $id,
        string $acronym,
        string $fullName,
        string $address
    ): self {
        return new self(
            $id,
            $acronym,
            $fullName,
            $address
        );
    }

    public function id(): IntegerId
    {
        return $this->id;
    }

    public function acronym(): string
    {
        return $this->acronym;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function updateAcronym(string $acronym): void
    {
        $this->acronym = $acronym;
    }

    public function updateFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function updateAddress(string $address): void
    {
        $this->address = $address;
    }
}
