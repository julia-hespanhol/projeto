<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\DeleteMember;

final class DeleteMemberCommand
{
    private $id;
    

    public function __construct(
       int $id;
    ) {
        $this->id = $id;
    }

    public static function fromHttpRequest(array $input): self
    {
        $command = new self(
            $input['id']
        );

        return $command;
    }

    public function id(): int
    {
        return $this->id;
    }

}
