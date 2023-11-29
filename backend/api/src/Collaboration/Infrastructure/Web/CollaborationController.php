<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Infrastructure\Web;

use Exception;
use Glance\Onboarding\Collaboration\Application\GetExperimentDetails\ExperimentViewRepositoryInterface;
use Glance\Onboarding\Collaboration\Application\RegisterExperiment\RegisterExperimentCommand;
use Glance\Onboarding\Collaboration\Application\RegisterExperiment\RegisterExperimentHandler;
use Glance\Onboarding\Collaboration\Application\GetMemberDetails\MemberViewRepositoryInterface;
use Glance\Onboarding\Collaboration\Application\RegisterMember\RegisterMemberCommand;
use Glance\Onboarding\Collaboration\Application\RegisterMember\RegisterMemberHandler;
use Glance\Onboarding\Collaboration\Application\UpdateMember\UpdateMemberCommand;
use Glance\Onboarding\Collaboration\Application\UpdateMember\UpdateMemberHandler;
use Glance\Onboarding\Collaboration\Application\DeleteMember\DeleteMemberCommand;
use Glance\Onboarding\Collaboration\Application\DeleteMember\DeleteMemberHandler;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CollaborationController
{
    private $experimentDetailsRepository;
    private $registerExperimentHandler;

    private $memberDetailsRepository;
    private $registerMemberHandler;
    private $updateMemberHandler;
    private $deleteMemberHandler;

    public function __construct(
        ExperimentViewRepositoryInterface $experimentDetailsRepository,
        RegisterExperimentHandler $registerExperimentHandler,
        
        MemberViewRepositoryInterface $memberDetailsRepository,
        RegisterMemberHandler $registerMemberHandler,
        UpdateMemberHandler $updateMemberHandler,
        DeleteMemberHandler $deleteMemberHandler

    ) {
        $this->experimentDetailsRepository = $experimentDetailsRepository;
        $this->registerExperimentHandler = $registerExperimentHandler;

        $this->memberDetailsRepository = $memberDetailsRepository;
        $this->registerMemberHandler = $registerMemberHandler;
        $this->updateMemberHandler = $updateMemberHandler;
        $this->deleteMemberHandler = $deleteMemberHandler;
       
    }

    public function findMembers(Request $request, Response $response): Response
    {
        $response->getBody()->write(
            json_encode([
                "members" => $this->memberDetailsRepository->findAllMembers()
            ])
        );

        return $response->withAddedHeader("Content-Type", "application/json");
    }

    public function findMemberById(Request $request, Response $response, array $args): Response
    {   
        $id = (int) $args['id'];

        $member = $this->memberDetailsRepository->findDetailsById($id);

        if (!$member) {
            throw new HttpNotFoundException($request, "Member not found with id: {$id}");
        }

        $response->getBody()->write(json_encode(["member" => $member]));
        return $response->withAddedHeader("Content-Type", "application/json");

    }

    public function updateMember(Request $request, Response $response, array $args): Response
    {
       
            $rawInput = $request->getBody()->getContents();
            $input = json_decode($rawInput, true);
            //var_dump($input);
            $memberId = (int) $args['id'];

            $command = UpdateMemberCommand::fromHttpRequest($input["member"], $memberId);
            try {
                $member = $this->updateMemberHandler->handle($command, $memberId);
            } catch (\InvalidArgumentException $e) {
                $this->throwForbiddenException($e->getMessage());
            } catch (\DomainException $e) {
                $this->throwForbiddenException($e->getMessage());
            }
     
            $responseBody = json_encode(["member" => $this->memberDetailsRepository->findDetailsById($memberId)]);
            $response->getBody()->write($responseBody);

            return $response->withHeader("content-type", "application/json");

    } 

    public function registerMember(Request $request, Response $response): Response
    {
        $input = json_decode($request->getBody()->getContents(), true);
        var_dump($input);

        $command = RegisterMemberCommand::fromHttpRequest($input["member"]);

        try {
            $member = $this->registerMemberHandler->handle($command);
        } catch (Exception $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $response->getBody()->write(
            json_encode([
                "member" => $this->memberDetailsRepository->findDetailsById(
                $member->id()->toInteger())
                    ])
        );

        return $response->withAddedHeader("Content-Type", "application/json");
    }

    public function deleteMember(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];

        $member = $this->memberViewRepository->findDetailsById($id);

        if (!$member) {
            throw new HttpNotFoundException($request, "Member not found with id: {$id}");
        }

       $response->getBody()->write(json_encode([$this->deleteMemberHandler->deleteMember($id)]));

       return $response->withHeader("content-type", "application/json");
    }

    public function findExperiments(Request $request, Response $response): Response
    {
        $response->getBody()->write(
            json_encode([
                "experiments" => $this->experimentDetailsRepository->findAllExperiments()
            ])
        );

        return $response->withAddedHeader("Content-Type", "application/json");
    }

    public function findExperimentById(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];

        $experiment = $this->experimentDetailsRepository->findDetailsById($id);

        if (!$experiment) {
            throw new HttpNotFoundException($request, "Experiment not found with id: {$id}");
        }

        $response->getBody()->write(json_encode(["experiment" => $experiment]));
        return $response->withAddedHeader("Content-Type", "application/json");
    }

    public function registerExperiment(Request $request, Response $response): Response
    {
        $input = json_decode($request->getBody()->getContents(), true);

        $command = RegisterExperimentCommand::fromHttpRequest($input["experiment"]);

        try {
            $experiment = $this->registerExperimentHandler->handle($command);
        } catch (Exception $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $response->getBody()->write(
            json_encode([
                "experiment" => $this->experimentDetailsRepository->findDetailsById(
                $experiment->id()->toInteger())
                    ])
        );

        return $response->withAddedHeader("Content-Type", "application/json");
    }

    public function updateExperiment(Request $request, Response $response, array $args): Response
    {
    }

    public function findMembersByExperimentId(Request $request, Response $response, array $args): Response
    {
    }

    public function deleteExperiment(Request $request, Response $response, array $args): Response
    {
    }

}