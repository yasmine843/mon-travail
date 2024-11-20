<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../config/config.php');


class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    // Méthode pour inscrire un utilisateur
    public function signUp($username, $password, $confirmPassword) {
        return $this->user->register($username, $password, $confirmPassword);
    }

    // Méthode pour connecter un utilisateur
    public function signIn($username, $password) {
        return $this->user->login($username, $password);
    }
}
?>
