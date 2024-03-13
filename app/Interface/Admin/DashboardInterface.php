<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    //landing
    public function deleteLandingRepositories($id): void;
    public function updateLandingRepositories($model, $request): void;
    //contacts
    public function updateContactsRepositories($model, $request): void;
    public function deleteContactsRepositories($model): void;
}
