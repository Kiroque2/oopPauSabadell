<?php

namespace App\School\Repositories;

interface IUserRepository {
    public function getUserByEmail(string $email);
    public function createUser(string $firstName, string $lastName, string $email, string $password, string $role): int;
}