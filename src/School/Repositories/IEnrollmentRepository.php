<?php

namespace App\School\Repositories;

use App\School\Entities\Enrollment;

interface IEnrollmentRepository {
    public function save(Enrollment $enrollment);
    public function findByDni(string $dni);
    public function getAllEnrollments(): array; // <-- Añadido
}
