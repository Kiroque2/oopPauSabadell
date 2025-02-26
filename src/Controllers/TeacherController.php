<?php

namespace App\Controllers;

use App\Infrastructure\Persistence\TeacherRepository;
use App\Infrastructure\Persistence\UserRepository;
use App\Infrastructure\Persistence\DepartmentRepository;
use App\School\Entities\Teacher;
use App\School\Entities\Department;
use App\School\Entities\User;

class TeacherController {
    private $teacherRepository;
    private $userRepository;
    private $departmentRepository;

    public function __construct(TeacherRepository $teacherRepository, UserRepository $userRepository, DepartmentRepository $departmentRepository) {
        $this->teacherRepository = $teacherRepository;
        $this->userRepository = $userRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $users = $this->userRepository->findAll();  
        $departments = $this->departmentRepository->findAll(); 
        $teachers = $this->teacherRepository->findAll();


        echo view('teacher', [
            'title' => 'Assign Teacher',
            'users' => $users,
            'departments' => $departments,
            'teachers' => $teachers
        ]);
    }
    

    public function store() {
        if (isset($_POST['user_id']) && isset($_POST['department_id'])) {
            
            $userId = (int)$_POST['user_id'];
            $departmentId = (int)$_POST['department_id'];

            $user = $this->userRepository->getUserById($userId);
            $department = $this->departmentRepository->getDepartmentById($departmentId);
    
            if (!$user) {
                $message = 'Error: User not found';
            } elseif (!$department) {
                $message = 'Error: Department not found';
            } else {

                $teacher = new Teacher(null, $userId, $departmentId);
    
      
                if ($this->teacherRepository->createTeacher($teacher)) {
                    $message = 'Teacher assigned successfully';
                    header('Location: /teacher');
                    exit;
                } else {
                    $message = 'Error: Could not assign teacher';
                }
            }
        } else {
            $message = 'Error: User ID and Department ID are required';
        }

        $data = ['message' => $message, 'error' => true];
        echo view('teacher', $data);
    }
}
