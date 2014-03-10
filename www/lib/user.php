<?php

include_once __DIR__.'/../fns/signed_user.php';
include_once __DIR__.'/mysqli.php';
$user = signed_user($mysqli);
if ($user) $idusers = $user->idusers;
else $idusers = null;
