<?php

namespace App\School\Services;

use App\School\Repositories\IUserRepository;
use App\School\Repositories\IStudentRepository;
use App\School\Repositories\ICourseRepository;

class AssignStudentCourseService {
    private $userRepository;
    private $studentRepository;
    private $courseRepository;

    public function __construct(
        UserRepository $userRepository,
        StudentRepository $studentRepository,
        CourseRepository $courseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
    }

    public function execute($userId, $courseId) {
        // Verificar o crear User
        $user = $this->userRepository->find($userId);
        if (!$user) {
            $user = new User($userId, "Nombre del Usuario");
            $this->userRepository->save($user);
        }

        // Verificar o crear Student
        $student = $this->studentRepository->findByUserId($userId);
        if (!$student) {
            $student = new Student($user);
            $this->studentRepository->save($student);
        }

        // Verificar o crear Course
        $course = $this->courseRepository->find($courseId);
        if (!$course) {
            $course = new Course($courseId, "Nombre del Curso");
            $this->courseRepository->save($course);
        }

        // Asignar Student a Course
        $student->assignToCourse($course);
        $this->studentRepository->save($student);
    }
}