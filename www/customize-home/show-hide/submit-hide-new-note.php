<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNewNote.php';
include_once '../../lib/mysqli.php';
Users\showNewNote($mysqli, $user->id_users, false);

$_SESSION['customize-home/show-hide/messages'] = [
    '"New Note" is now hidden.',
];

include_once '../../fns/redirect.php';
redirect();
