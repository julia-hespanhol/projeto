<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Infrastructure\Persistence;

use Doctrine\DBAL\Driver\Connection;
use Glance\Onboarding\Collaboration\Application\GetExperimentDetails\ExperimentViewRepositoryInterface;
use Glance\Onboarding\Collaboration\Application\GetExperimentDetails\Experiment as ExperimentDetails;
use Glance\Onboarding\Collaboration\Domain\Experiment;
use Glance\Onboarding\Collaboration\Domain\ExperimentReadRepositoryInterface;
use Glance\Onboarding\Collaboration\Domain\ExperimentWriteRepositoryInterface;

class SqlExperimentRepository implements
    ExperimentViewRepositoryInterface,
    ExperimentReadRepositoryInterface,
    ExperimentWriteRepositoryInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findNextExperimentId(): int
    {
        $query = "SELECT MAX(ID) + 1 AS NEXT_ID FROM EXPERIMENT";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return (int) $statement->fetchOne();
    }

    public function findAllExperiments(): array
    {
        $query = "SELECT
                E.ID AS ID,
                E.ACRONYM AS ACRONYM,
                E.FULL_NAME AS FULL_NAME,
                E.ADDRESS AS ADDRESS
            FROM EXPERIMENT E
        ";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return array_map(function (array $row) {
            return ExperimentDetails::fromPersistence($row);
        }, $statement->fetchAllAssociative());
    }

    public function findDetailsById(int $id): ?ExperimentDetails
    {
        $query = "SELECT
                E.ID AS ID,
                E.ACRONYM AS ACRONYM,
                E.FULL_NAME AS FULL_NAME,
                E.ADDRESS AS ADDRESS
            FROM EXPERIMENT E
            WHERE E.ID = :id
        ";
        $statement = $this->connection->prepare($query);
        $payload = [
            'id' => $id
        ];
        $statement->execute($payload);
        $rows = $statement->fetchAllAssociative();

        return $rows ? ExperimentDetails::fromPersistence($rows[0]) : null;
    }

    public function findById(int $id): Experiment
    {
        $query = "SELECT
                E.ID AS ID,
                E.ACRONYM AS ACRONYM,
                E.FULL_NAME AS FULL_NAME,
                E.ADDRESS AS ADDRESS
            FROM EXPERIMENT E
            WHERE E.ID = :id
        ";
        $statement = $this->connection->prepare($query);
        $payload = [
            'id' => $id
        ];
        $statement->execute($payload);
        $rows = $statement->fetchAllAssociative();

        return Experiment::fromPersistence($rows[0]);
    }

    public function registerExperiment(Experiment $experiment): void
    {
        $query = "INSERT
            INTO EXPERIMENT (
                ID,
                ACRONYM,
                FULL_NAME,
                ADDRESS
            ) VALUES (
                :id,
                :acronym,
                :fullName,
                :address
            )
        ";
        $statement = $this->connection->prepare($query);
        $payload = [
            'id' => $experiment->id()->toInteger(),
            'acronym' => $experiment->acronym(),
            'fullName' => $experiment->fullName(),
            'address' => $experiment->address()
        ];
        $statement->execute($payload);
    }
}
