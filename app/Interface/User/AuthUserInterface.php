<?php

namespace App\Interface\User;

interface AuthUserInterface
{
    public function loginRepositories(): void;
    public function registerRepositories(): void;
}
