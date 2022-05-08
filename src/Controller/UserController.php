<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: /admin");
        }
        $errorMessage = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userName = trim($_POST['userName']);
            $password = trim($_POST['password']);

            $userManager = new UserManager();
            $user = $userManager->getUserByPseudo($userName);

            if ($user && $user['password'] === $password) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: /admin");
                return null;
            } else {
                $errorMessage = 'Mot de passe ou pseudo incorrect';
            }
        }
        return $this->twig->render('Admin/login.html.twig', ['errorMessage' => $errorMessage]);
    }

    public function logout()
    {
        session_unset();
        header("Location: /admin/login");
        return null;
    }
}
