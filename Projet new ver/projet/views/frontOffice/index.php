<?php
require_once(__DIR__ . '/../../controllers/UserController.php');



// Démarrer la session
session_start(); 

// Initialiser le contrôleur des utilisateurs
$userController = new UserController($db);
$error = '';

// Traiter les actions d'inscription ou de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Inscription
    if ($action === 'signup') {
        $result = $userController->signUp($username, $password, $confirmPassword);
        if ($result !== true) {
            $error = $result; // Récupérer le message d'erreur
        } else {
            // Rediriger vers la page de connexion après l'inscription réussie
            header("Location: index.php?action=signin");
            exit();
        }
    } 
    // Connexion
    elseif ($action === 'signin') {
        $result = $userController->signIn($username, $password); // Utiliser signIn() au lieu de login()
        if ($result === true) {
            // Connexion réussie, stocker le nom d'utilisateur en session
            $_SESSION['username'] = $username;
            
            // Vérifier si l'utilisateur est admin ou visitor
            // Redirection après connexion réussie
            if (str_ends_with($username, '.admin')) {
                header("Location: ../../views/backOffice/homeAdmin.php"); // Page admin
            } else {
                header("Location: ../../views/frontOffice/homeUser.php"); // Page utilisateur
            }
            exit();

        } else {
            $error = $result; // Récupérer le message d'erreur
        }
    }
}

// Inclure la vue HTML
require_once '../frontOffice/login.php';
?>
