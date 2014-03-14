<?php

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/showNewTask.php';
include_once '../lib/mysqli.php';
Users\showNewTask($mysqli, $user->idusers, true);

include_once '../fns/redirect.php';
redirect();
