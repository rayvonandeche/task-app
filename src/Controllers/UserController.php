<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../Services/MailerService.php';

class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showRegistrationForm()
    {
        require __DIR__ . '/../../views/register_form.php';
    }

    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Invalid email format');
        }

        $user = new User($this->db);
        $user->name = $name;
        $user->email = $email;

        if ($user->save()) {
            try {
                MailerService::sendWelcomEmail($name, $email);
            } catch (Exception $e) {
                error_log('Failed to send welcome email: ' . $e->getMessage());
            }
            header('Location: /task-app/public/index.php?action=listUsers');
            exit(); 
        } else {
            die('Error saving user');
        }
    }

    public function listUsers()
    {
        $users = User::findAll($this->db);
        require __DIR__ . '/../../views/user_list.php';
    }
}
