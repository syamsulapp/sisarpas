<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    //landing
    public function deleteLandingRepositories($id): void;
    public function updateLandingRepositories($request): void;
    //contacts
    public function updateContactsRepositories($request): void;
    public function deleteContactsRepositories($id): void;
}
