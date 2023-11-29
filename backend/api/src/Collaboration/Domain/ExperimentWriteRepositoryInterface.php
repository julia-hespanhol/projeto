<?php

namespace Glance\Onboarding\Collaboration\Domain;

interface ExperimentWriteRepositoryInterface
{
    public function registerExperiment(Experiment $experiment): void;
}
