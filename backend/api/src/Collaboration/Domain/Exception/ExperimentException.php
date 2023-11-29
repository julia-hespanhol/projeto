<?php

namespace Glance\Onboarding\Collaboration\Domain\Exception;

use DomainException;

class ExperimentException extends DomainException
{
    public static function experimentNotFound(): self
    {
        $message = "Experiment not found.";
        return new self($message);
    }

    
}
