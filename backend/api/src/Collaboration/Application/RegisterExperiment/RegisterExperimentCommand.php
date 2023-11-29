<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\RegisterExperiment;

final class RegisterExperimentCommand
{
    private $acronym;
    private $fullName;
    private $address;

    public function __construct(
        string $acronym,
        string $fullName,
        string $address
    ) {
        $this->acronym = $acronym;
        $this->fullName = $fullName;
        $this->address = $address;
    }

    public static function fromHttpRequest(array $input): self
    {
        $command = new self(
            $input['acronym'],
            $input['fullName'],
            $input['address']
        );

        return $command;
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
}
