<?php

namespace Glance\Onboarding\Collaboration\Domain;

interface ExperimentReadRepositoryInterface
{
    public function findNextExperimentId(): int;
    public function findById(int $id): Experiment;
}
