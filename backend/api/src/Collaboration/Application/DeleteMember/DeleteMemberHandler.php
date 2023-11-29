<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\DeleteMember;

use Glance\Onboarding\Collaboration\Domain\Member;
use Glance\Onboarding\Collaboration\Domain\MemberReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\MemberWriteRepositoryInterface;


final class DeleteMemberHandler
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

    public function handle(DeleteMemberCommand $command): void
    {
        
        $this->memberWriteRepository->deleteMember($command);

    }

    
}
