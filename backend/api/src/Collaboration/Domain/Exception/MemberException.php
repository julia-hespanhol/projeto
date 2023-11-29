<?php

namespace Glance\Onboarding\Collaboration\Domain\Exception;

use DomainException;

class MemberException extends DomainException
{
    public static function memberNotFound(): self
    {
        $message = "Member not found.";
        return new self($message);
    }
}