<?php
define('VIEWS', __DIR__ . '/src/views');
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controllers\HomeController;
use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Routing\Router;
use App\Controllers\TeacherController;
use App\Controllers\DepartmentController;
use App\Controllers\CourseController;
use App\Controllers\StudentController;
use App\Infrastructure\Persistence\UserRepository;
use App\Infrastructure\Persistence\TeacherRepository;
use App\Infrastructure\Persistence\DepartmentRepository;
use App\Infrastructure\Persistence\CourseRepository;
use App\Infrastructure\Persistence\StudentRepository;
use App\School\Services\Services;

$pdo = DatabaseConnection::getConnection();

if (!$pdo) {
    die("Error: No se pudo establecer la conexión a la base de datos.");
}

$services = new Services();
$services->addServices('db', fn() => $pdo);

// Obtener base de datos correctamente
$db = $services->getService('db');

// Registrar repositorios en los servicios
$services->addServices('userRepository', fn() => new UserRepository($db));
$services->addServices('teacherRepository', fn() => new TeacherRepository($db));
$services->addServices('departmentRepository', fn() => new DepartmentRepository($db));
$services->addServices('courseRepository', fn() => new CourseRepository($db));
$services->addServices('studentRepository', fn() => new StudentRepository($db));

// Obtener repositorios desde los servicios
$userRepo = $services->getService('userRepository');
$teacherRepo = $services->getService('teacherRepository');
$departmentRepo = $services->getService('departmentRepository');
$courseRepo = $services->getService('courseRepository');
$studentRepo = $services->getService('studentRepository');

// Crear instancias de los controladores con las dependencias correctas
$router = new Router();
$router->addRoute('GET', '/', [new HomeController(), 'index'])
    ->addRoute('GET', '/teachers', [new TeacherController($teacherRepo, $userRepo, $departmentRepo), 'index'])
    ->addRoute('GET', '/add-teachers', [new TeacherController($teacherRepo, $userRepo, $departmentRepo), 'addteacher'])
    ->addRoute('GET', '/course', [new CourseController($courseRepo), 'index'])
    ->addRoute('GET', '/add-course', [new CourseController($courseRepo), 'addcourse'])
    ->addRoute('GET', '/student', [new StudentController($studentRepo, $userRepo), 'index'])  // Aquí se pasa UserRepository también
    ->addRoute('GET', '/add-student', [new StudentController($studentRepo, $userRepo), 'addstudent'])  // Igualmente aquí
    ->addRoute('GET', '/department', [new DepartmentController($departmentRepo), 'index'])
    ->addRoute('GET', '/add-department', [new DepartmentController($departmentRepo), 'adddepartment'])
    ->addRoute('GET', '/teacher', [new TeacherController($teacherRepo, $userRepo, $departmentRepo), 'index'])
    ->addRoute('POST', '/teacher', [new TeacherController($teacherRepo, $userRepo, $departmentRepo), 'store']);
