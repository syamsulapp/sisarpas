<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    public function deleteLandingRepositories($id): void;
    public function updateLandingRepositories($request): void;
}
