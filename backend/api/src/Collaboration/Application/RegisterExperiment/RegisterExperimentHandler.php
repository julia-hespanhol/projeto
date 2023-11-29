<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\RegisterExperiment;

use Glance\Onboarding\Collaboration\Domain\Experiment;
use Glance\Onboarding\Collaboration\Domain\ExperimentReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\ExperimentWriteRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\IntegerId;

final class RegisterExperimentHandler
{
    private $experimentReadRepository;
    private $experimentWriteRepository;

    public function __construct(
        ExperimentReadRepositoryInterface $experimentReadRepository,
        ExperimentWriteRepositoryInterface $experimentWriteRepository
    ) {
        $this->experimentWriteRepository = $experimentWriteRepository;
        $this->experimentReadRepository = $experimentReadRepository;
    }

    public function handle(RegisterExperimentCommand $command): Experiment
    {
        $id = new IntegerId(
            $this->experimentReadRepository->findNextExperimentId()
        );

        $experiment = Experiment::create(
            $id,
            $command->acronym(),
            $command->fullName(),
            $command->address()
        );

        $this->experimentWriteRepository->registerExperiment($experiment);

        return $experiment;
    }
}
