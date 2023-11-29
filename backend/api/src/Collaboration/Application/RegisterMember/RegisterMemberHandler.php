<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\RegisterMember;

use Glance\Onboarding\Collaboration\Domain\Member;
use Glance\Onboarding\Collaboration\Domain\MemberReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\MemberWriteRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\IntegerId;

final class RegisterMemberHandler
{
    private $memberReadRepository;
    private $memberWriteRepository;

    public function __construct(
        MemberReadRepositoryInterface $memberReadRepository,
        MemberWriteRepositoryInterface $memberWriteRepository
    ) {
        $this->memberWriteRepository = $memberWriteRepository;
        $this->memberReadRepository = $memberReadRepository;
    }

    public function handle(RegisterMemberCommand $command): Member
    {
        $id = new IntegerId(
            $this->memberReadRepository->findNextMemberId()
        );

        $member = Member::create(
            $id,
            $command->firstName(),
            $command->lastName(),
            $command->email(),
            $command->age(),
            $command->experimentId()
        );

        $this->memberWriteRepository->registerMember($member);

        return $member;
    }

    
}
