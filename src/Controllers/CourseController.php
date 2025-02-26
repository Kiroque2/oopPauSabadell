<?php

namespace App\Controllers;

use App\Infrastructure\Persistence\CourseRepository;
use App\School\Entities\Course;

class CourseController {

    private $courseRepository;

    public function __construct(CourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function index() {
        $courses = $this->courseRepository->getAllCourses(); 
        $data = ['courses' => $courses, 'title' => 'Courses List'];
        echo view('course', $data); 
    }

    public function store() {
        if (isset($_POST['name']) && $_POST['name'] !== '' && isset($_POST['degree_id']) && $_POST['degree_id'] !== '') {
            $name = $_POST['name'];
            $degreeId = $_POST['degree_id'];  // Obtener degree_id desde el formulario

            // Crear un nuevo curso con nombre y degree_id
            $course = new Course($name, $degreeId);  // Pasar el degree_id

            // Insertar el curso en la base de datos
            $this->courseRepository->createCourse($course);

            // Redirigir después de la creación
            header('Location: /course');
            exit;
        } else {
            // Si falta algún campo, muestra un error
            $data = ['message' => 'Error: All fields are required', 'error' => true];
            echo view('course', $data);
        }
    }
}
