<?php
session_start();
include 'includes/class-autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $gebdat = $_POST['gebdat'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $usersObj = new UsersContr();
    if (!$usersObj->getUser($email)) {
        $usersObj->createUser($voornaam, $achternaam, $gebdat, $email, $wachtwoord);
        echo "Registratie succesvol! Je kunt nu inloggen.";
    } else {
        echo "Gebruiker bestaat al.";
    }
}