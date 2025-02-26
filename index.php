<?php

require __DIR__.'/bootstrap.php';

use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Persistence\CourseRepository;
use App\Infrastructure\Persistence\DegreeRepository;
use App\Infrastructure\Persistence\DepartmentRepository;
use App\Infrastructure\Persistence\EnrollmentRepository;
use App\Infrastructure\Persistence\ExamRepository;
use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\SubjectRepository;
use App\Infrastructure\Persistence\TeacherRepository;
use App\Infrastructure\Persistence\UserRepository;
use App\Controllers\UserController;
use App\Controllers\CourseController;
use App\Controllers\DegreeController;
use App\Controllers\DepartmentController;
use App\Controllers\EnrollmentController;
use App\Controllers\ExamController;
use App\Controllers\StudentController;
use App\Controllers\SubjectController;
use App\Controllers\TeacherController;
use App\Infrastructure\Routing\Response;

// Definir las rutas
$routes = [
    'home' => '/',
    'teachers' => '/teacher',
    'courses' => '/course',
    'students' => '/student',
    'departments' => '/department',
    'degrees' => '/degree',
    'enrollments' => '/enrollments',
    'exams' => '/exams',
    'subjects' => '/subjects',
    'users' => '/user',
];

$pdo = DatabaseConnection::getConnection();

// Repositorios
$courseRepository = new CourseRepository($pdo);
$degreeRepository = new DegreeRepository($pdo);
$departmentRepository = new DepartmentRepository($pdo);
$enrollmentRepository = new EnrollmentRepository($pdo);
$examRepository = new ExamRepository($pdo);
$studentRepository = new StudentRepository($pdo);
$subjectRepository = new SubjectRepository($pdo);
$teacherRepository = new TeacherRepository($pdo);
$userRepository = new UserRepository($pdo);

// Crear los controladores con las dependencias correctas
$userController = new UserController($userRepository);
$departmentController = new DepartmentController($departmentRepository);
$courseController = new CourseController($courseRepository);
$degreeController = new DegreeController($degreeRepository);
$teacherController = new TeacherController($teacherRepository, $userRepository, $departmentRepository);
$studentController = new StudentController($studentRepository, $userRepository);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$entities = [
    'courses' => $routes['courses'],
    'degrees' => $routes['degrees'],
    'departments' => $routes['departments'],
    'enrollments' => $routes['enrollments'],
    'exams' => $routes['exams'],
    'students' => $routes['students'],
    'subjects' => $routes['subjects'],
    'teachers' => $routes['teachers'],
    'users' => $routes['users'],
];

// Rutas
if ($uri === $routes['home'] && $method === 'GET') {
    $data = ['name' => 'CEFPNuria', 'entities' => $entities, 'routes' => $routes];
    echo view('home', $data);
} elseif ($uri === $routes['users'] && $method === 'GET') {
    $userController->index();
} elseif ($uri === $routes['users'] && $method === 'POST') {
    $userController->store();
} elseif ($uri === $routes['teachers'] && $method === 'GET') {
    $teacherController->index();
} elseif ($uri === $routes['departments'] && $method === 'GET') {
    $departmentController->index();
} elseif ($uri === $routes['departments'] && $method === 'POST') {
    $departmentController->store();
} elseif ($uri === $routes['courses'] && $method === 'GET') {
    $courseController->index();
} elseif ($uri === $routes['courses'] && $method === 'POST') {
    $courseController->store();
} elseif ($uri === $routes['degrees'] && $method === 'GET') {
    $degreeController->index();
} elseif ($uri === $routes['degrees'] && $method === 'POST') {
    $degreeController->store();
}elseif ($uri === $routes['students'] && $method === 'GET') {
    $studentController->store();
} elseif ($uri === $routes['students'] && $method === 'POST') {
    $studentController->store();
}  else {
    echo "Page not found.";
}
