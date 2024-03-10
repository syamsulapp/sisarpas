<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    public function deleteLandingRepositories($request): void;
    public function updateLandingRepositories($id): void;
}
