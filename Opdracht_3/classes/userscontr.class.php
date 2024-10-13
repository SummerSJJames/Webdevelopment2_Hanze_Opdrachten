<?php
  class UsersContr extends Users {
    public function createUser($voornaam, $achternaam, $gebdat, $username, $password) {
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $this->setUser($voornaam, $achternaam, $gebdat, $username, $hashedPwd);
    }

    public function loginUser($username, $password) {
        $user = $this->checkUserLogin($username, $password);
        if ($user) {
            session_start();
            $_SESSION['userid'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}