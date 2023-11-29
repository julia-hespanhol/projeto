<?php

declare(strict_types=1);

namespace Glance\Onboarding\Collaboration\Infrastructure\Web;

use Slim\App;

class CollaborationRoutes
{
    public static function addRoutes(App $app): void
    {
        // Experiment routes
        $app->get("/experiments", [CollaborationController::class, "findExperiments"]);
        $app->get("/experiments/{id}", [CollaborationController::class, "findExperimentById"]);
        // $app->get("/experiments/{id}/members", [CollaborationController::class, "findMembersByExperimentId"]);
        $app->post("/experiments", [CollaborationController::class, "registerExperiment"]);
        // $app->patch("/experiments/{id}", [CollaborationController::class, "updateExperiment"]);
        // $app->delete("/experiments/{id}", [CollaborationController::class, "deleteExperiment"]);

        // Member routes
        $app->get("/members", [CollaborationController::class, "findMembers"]);
        $app->get("/members/{id}", [CollaborationController::class, "findMemberById"]);
        $app->post("/members", [CollaborationController::class, "registerMember"]);
        $app->patch("/members/{id}", [CollaborationController::class, "updateMember"]);
        $app->delete("/members/{id}", [CollaborationController::class, "deleteMember"]);
    }
}
