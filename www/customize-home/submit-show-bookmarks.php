<?php

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/showBookmarks.php';
include_once '../lib/mysqli.php';
Users\showBookmarks($mysqli, $user->idusers, true);

include_once '../fns/redirect.php';
redirect();
