<?php

include_once 'session-start.php';
$user = $idusers = null;
if (array_key_exists('user', $_SESSION)) {
    include_once __DIR__.'/../classes/Users.php';
    $user = Users::get($_SESSION['user']->idusers);
    if ($user) {
        $idusers = $user->idusers;
    }
}
