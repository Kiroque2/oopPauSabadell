<?php

namespace App\School\Services;

use App\School\Repositories\IUserRepository;
use App\School\Repositories\ITeacherRepository;
use App\School\Repositories\IDepartmentRepository;
use App\Infrastructure\Persistence\UserRepository;
use App\Infrastructure\Persistence\DepartmentRepository;
use App\Infrastructure\Persistence\TeacherRepository;

class AssignTeacherDepartmentService {
    private $userRepository;
    private $teacherRepository;
    private $departmentRepository;

    public function __construct(
        UserRepository $userRepository,
        TeacherRepository $teacherRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->teacherRepository = $teacherRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function execute($userId, $departmentId) {
        // Verificar o crear User
        $user = $this->userRepository->find($userId);
        if (!$user) {
            $user = new User($userId, "Nombre del Usuario");
            $this->userRepository->save($user);
        }

        // Verificar o crear Teacher
        $teacher = $this->teacherRepository->findByUserId($userId);
        if (!$teacher) {
            $teacher = new Teacher($user);
            $this->teacherRepository->save($teacher);
        }

        // Verificar o crear Department
        $department = $this->departmentRepository->find($departmentId);
        if (!$department) {
            $department = new Department($departmentId, "Nombre del Departamento");
            $this->departmentRepository->save($department);
        }

        // Asignar Teacher a Department
        $teacher->assignToDepartment($department);
        $this->teacherRepository->save($teacher);
    }
}