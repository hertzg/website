<?php

include_once __DIR__.'/../fns/signed_user.php';
include_once __DIR__.'/mysqli.php';
list($user, $idusers) = signed_user($mysqli);
