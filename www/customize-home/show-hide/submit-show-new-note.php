<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNewNote.php';
include_once '../../lib/mysqli.php';
Users\showNewNote($mysqli, $user->idusers, true);

$_SESSION['customize-home/show-hide/messages'] = [
    '"New Note" is now visible.',
];

include_once '../../fns/redirect.php';
redirect();
