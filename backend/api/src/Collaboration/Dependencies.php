<?php

namespace Glance\Onboarding\Collaboration;

use Doctrine\DBAL\Driver\Connection;
use Glance\Onboarding\Collaboration\Application\GetExperimentDetails\ExperimentViewRepositoryInterface;
use Glance\Onboarding\Collaboration\Application\GetMemberDetails\MemberViewRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\ExperimentReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\ExperimentWriteRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\MemberReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\MemberWriteRepositoryInterface;
use Glance\Onboarding\Collaboration\Infrastructure\Persistence\SqlExperimentRepository;
use Glance\Onboarding\Collaboration\Infrastructure\Persistence\SqlMemberRepository;

final class Dependencies
{
    public static function definitions(): array
    {
        return [
            ExperimentViewRepositoryInterface::class => function (Connection $connection) {
                return new SqlExperimentRepository($connection);
            },
            ExperimentReadRepositoryInterface::class => function (Connection $connection) {
                return new SqlExperimentRepository($connection);
            },
            ExperimentWriteRepositoryInterface::class => function (Connection $connection) {
                return new SqlExperimentRepository($connection);
            },
            MemberViewRepositoryInterface::class => function (Connection $connection) {
                return new SqlMemberRepository($connection);
            },
            MemberReadRepositoryInterface::class => function (Connection $connection) {
                return new SqlMemberRepository($connection);
            },
            MemberWriteRepositoryInterface::class => function (Connection $connection) {
                return new SqlMemberRepository($connection);
            },
            
        ];
    }
}
