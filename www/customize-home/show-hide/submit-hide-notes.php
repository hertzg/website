<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNotes.php';
include_once '../../lib/mysqli.php';
Users\showNotes($mysqli, $user->idusers, false);

$_SESSION['customize-home/show-hide/index_messages'] = array(
    '"Notes" is now hidden.',
);

include_once '../../fns/redirect.php';
redirect();
