<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\UpdateMember;

use Glance\Onboarding\Collaboration\Domain\Member;
use Glance\Onboarding\Collaboration\Domain\MemberReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\MemberWriteRepositoryInterface;

final class UpdateMemberHandler
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

    public function handle(UpdateMemberCommand $command, int $memberId): Member
    {
        $this->command = $command; 
        //$experimentId = new IntegerId($command->experimentId());
        $member = $this->memberReadRepository->findById($memberId);
        

       $member->update(
        $this->commandHasData('firstName') ? $command->firstName() : $member->firstName(),
        $this->commandHasData('lastName') ? $command->lastName() : $member->lastName(),
        $this->commandHasData('email') ? $command->email() : $member->email(),
        $this->commandHasData('age') ? $command->age() : $member->age(),
        $this->commandHasData('experimentId') ? $command->experimentId() : $member->experimentId()
       );
        
        $this->memberWriteRepository->updateMember($member, $memberId);

        return $member;
    }

    public function commandHasData(string $data): bool
    {
        return property_exists($this->command, $data) || $data !== null;
    }

    
}
