<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Domain;

use InvalidArgumentException;
use Webmozart\Assert\Assert;

class IntegerId
{
    /**
     * ID value.
     *
     * @var int
     */
    protected $id;

    public function __construct(int $id)
    {
        Assert::greaterThan($id, 0);

        $this->id = $id;
    }

    public static function fromString(string $id)
    {
        return new static((int) $id);
    }

    public static function fromInteger(int $id): self
    {
        return new static($id);
    }

    public static function createNewOrNull(?int $id): ?self
    {
        if (is_null($id)) {
            return null;
        }

        return new static($id);
    }

    public function equals(self $otherId): bool
    {
        return $this->id === $otherId->toInteger();
    }

    public function notEqualsTo(self $otherId): bool
    {
        return !$this->equals($otherId);
    }

    public function toInteger(): int
    {
        return $this->id;
    }

    public function toString(): string
    {
        return (string) $this->id;
    }
}
