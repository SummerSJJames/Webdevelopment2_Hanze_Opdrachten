<?php
  class UsersView extends Users {
    public function showUser($email) {
        $user = $this->getUser($email);
        if ($user) {
            echo "Naam: " . $user['voornaam'] . " " . $user['achternaam'] . "<br>";
            echo "Geboortedatum: " . $user['gebdat'];
        } else {
            echo "Geen gebruiker gevonden met deze naam.";
        }
    }
}