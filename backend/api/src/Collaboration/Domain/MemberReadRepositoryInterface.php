<?php

namespace Glance\Onboarding\Collaboration\Domain;

interface MemberReadRepositoryInterface
{
    public function findNextMemberId(): int;
    public function findById(int $id): Member;

}
