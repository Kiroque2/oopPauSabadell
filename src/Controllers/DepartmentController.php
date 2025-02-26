<?php
namespace App\Controllers;

use App\Infrastructure\Routing\Response;
use App\Infrastructure\Persistence\DepartmentRepository;

class DepartmentController {

    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository) {
        $this->departmentRepository = $departmentRepository;
    }

    public function index(): void {
        $departments = $this->departmentRepository->getAllDepartments();

        Response::html('department.view', [
            'title' => 'Department List',
            'departments' => $departments
        ])->send();
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $department = $this->departmentRepository->createDepartment($name);

            if ($department) {
                $message = 'Department created successfully!';
                $messageType = 'success';
            } else {
                $message = 'There was an error creating the department.';
                $messageType = 'error';
            }

            $departments = $this->departmentRepository->getAllDepartments();

            Response::html('department.view', [
                'title' => 'Department List',
                'departments' => $departments,
                'message' => $message,
                'messageType' => $messageType
            ])->send();
        }
    }
}
