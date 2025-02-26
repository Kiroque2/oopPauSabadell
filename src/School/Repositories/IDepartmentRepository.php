<?php

namespace App\School\Repositories;

interface IDepartmentRepository {
    public function getDepartmentByName(string $name);
    public function createDepartment(string $name): int;
}
