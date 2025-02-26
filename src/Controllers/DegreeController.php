<?php

namespace App\Controllers;

use App\Infrastructure\Persistence\DegreeRepository;
use App\School\Entities\Degree;

class DegreeController {

    private $degreeRepository;

    public function __construct(DegreeRepository $degreeRepository) {
        $this->degreeRepository = $degreeRepository;
    }

    // Mostrar la lista de grados
    public function index() {
        $degrees = $this->degreeRepository->getAllDegrees();
        $data = ['degrees' => $degrees, 'title' => 'Degrees List'];
        echo view('degree', $data); 
    }

    // Crear un nuevo grado
    public function store() {
        if (isset($_POST['name']) && $_POST['name'] !== '' && isset($_POST['duration_years']) && $_POST['duration_years'] > 0) {
            $name = $_POST['name'];
            $duration_years = (int)$_POST['duration_years'];

            $degree = new Degree(null, $name, $duration_years);

            if ($this->degreeRepository->createDegree($degree)) {
                header('Location: /degree');
                exit;
            } else {
                $data = ['message' => 'Error: Could not create degree', 'error' => true];
                echo view('degree', $data);  // Asegúrate de tener la vista 'degrees.view.php'
            }
        } else {
            $data = ['message' => 'Error: All fields are required', 'error' => true];
            echo view('degree', $data);  // Asegúrate de tener la vista 'degrees.view.php'
        }
    }
}
