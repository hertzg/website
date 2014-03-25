<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNewNote.php';
include_once '../../lib/mysqli.php';
Users\showNewNote($mysqli, $user->idusers, false);

$_SESSION['customize-home/show-hide/messages'] = array(
    '"New Note" is now hidden.',
);

include_once '../../fns/redirect.php';
redirect();
