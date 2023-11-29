<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\GetMemberDetails;

use Glance\Onboarding\Collaboration\Infrastructure\Persistence\SqlMemberRepository;


interface MemberViewRepositoryInterface
{
    public function findAllMembers(): array;
    public function findDetailsById(int $id): ?Member;
}
