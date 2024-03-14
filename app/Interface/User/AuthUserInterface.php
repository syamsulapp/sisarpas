<?php

namespace App\Interface\User;

interface AuthUserInterface
{
    public function loginRepositories();
    public function registerRepositories($user);
    public function logoutRepositories(): void;
    public function forgotPasswordRepositories($email): void;
    public function resetPasswordRepositories(): void;
}
