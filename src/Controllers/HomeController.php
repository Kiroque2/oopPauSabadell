<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        // Datos a pasar a la vista
        $data = [
            'name' => 'CEFPNuria',
            'entities' => [
                'Courses' => '/course',
                'Teachers' => '/teachers',
                'Students' => '/students',
            ]
        ];

        // Llamar a la vista y pasar los datos
        echo view('home', $data);
    }

    public function teachers() {
        echo 'teachers';
    }
}
