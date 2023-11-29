<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\GetExperimentDetails;

class Experiment implements \JsonSerializable
{
    private $id;
    private $acronym;
    private $fullName;
    private $address;

    public function __construct(
        int $id,
        string $acronym,
        string $fullName,
        string $address
    ) {
        $this->id = $id;
        $this->acronym = $acronym;
        $this->fullName = $fullName;
        $this->address = $address;
    }

    public static function fromPersistence(array $data): self
    {
        return new self(
            (int) $data['ID'],
            $data['ACRONYM'],
            $data['FULL_NAME'],
            $data['ADDRESS']
        );
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "acronym" => $this->acronym,
            "fullName" => $this->fullName,
            "address" => $this->address
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
