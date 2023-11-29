<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Application\GetExperimentDetails;

interface ExperimentViewRepositoryInterface
{
    public function findAllExperiments(): array;
    public function findDetailsById(int $id): ?Experiment;
}
