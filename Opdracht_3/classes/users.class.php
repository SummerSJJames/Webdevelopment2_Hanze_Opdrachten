<?php
class Users extends Dbh {

    public function getUserById($userId): mixed {
        $sql = "SELECT voornaam, achternaam FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?? null;
    }

    public function getUser($email): mixed {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?? null;
    }

    public function setUser($voornaam, $achternaam, $gebdat, $username, $hashedPwd) {
        $sql = "INSERT INTO users (voornaam, achternaam, gebdat, email, wachtwoord) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$voornaam, $achternaam, $gebdat, $username, $hashedPwd]);
    }

    public function checkUserLogin($username, $password): mixed {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['wachtwoord'])) {
            return $user;
        }
        return false;
    }
}