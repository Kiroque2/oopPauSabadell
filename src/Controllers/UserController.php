<?php

namespace App\Controllers;

use App\Infrastructure\Routing\Response;
use App\Infrastructure\Persistence\UserRepository;

class UserController {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(): void {
        $users = $this->userRepository->getAllUsers();
        
        Response::html('user.view', [
            'title' => 'User List',
            'users' => $users
        ])->send();
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userType = $_POST['user_type'];

            $user = $this->userRepository->createUser($firstName, $lastName, $email, $password, $userType);
            if ($user) {
                $message = 'User created successfully!';
                $messageType = 'success';
            } else {
                $message = 'There was an error creating the user.';
                $messageType = 'error';
            }

            $users = $this->userRepository->getAllUsers();

            Response::html('user.view', [
                'title' => 'User List',
                'users' => $users,
                'message' => $message,
                'messageType' => $messageType
            ])->send();
        }
    }
}
