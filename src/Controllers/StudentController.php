<?php

namespace App\Controllers;

use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\UserRepository;

class StudentController {
    private $studentRepository;
    private $userRepository;

    // Constructor esperando ambos parámetros
    public function __construct(StudentRepository $studentRepository, UserRepository $userRepository) {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
    }
    public function index() {
        $students = $this->studentRepository->getAllStudents();
        echo view('student', [
            'title' => 'Student List',
            'students' => $students
        ]);
    }

    public function store() {
        if (isset($_POST['user_id']) && isset($_POST['dni']) && isset($_POST['enrollment_year'])) {
            $userId = (int)$_POST['user_id'];
            $dni = $_POST['dni'];
            $enrollmentYear = (int)$_POST['enrollment_year'];

            $user = $this->userRepository->getUserById($userId);

            if (!$user) {
                $message = 'Error: User not found';
                $error = true;
            } else {
                if ($this->studentRepository->createStudent($userId, $dni, $enrollmentYear)) {
                    $message = 'Student created successfully';
                    $error = false;
                } else {
                    $message = 'Error: Could not create student';
                    $error = true;
                }
            }
        } else {
            $message = 'Error: All fields are required';
            $error = true;
        }

        $students = $this->studentRepository->getAllStudents();
        echo view('student', [
            'title' => 'Student List',
            'students' => $students,
            'message' => $message,
            'error' => $error
        ]);
    }

    public function delete($id) {
        if ($this->studentRepository->deleteStudentById($id)) {
            $message = 'Student deleted successfully';
            $error = false;
        } else {
            $message = 'Error: Could not delete student';
            $error = true;
        }

        $students = $this->studentRepository->getAllStudents();
        echo view('student', [
            'title' => 'Student List',
            'students' => $students,
            'message' => $message,
            'error' => $error
        ]);
    }
}

