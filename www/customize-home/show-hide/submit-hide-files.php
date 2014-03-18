<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showFiles.php';
include_once '../../lib/mysqli.php';
Users\showFiles($mysqli, $user->idusers, false);

$_SESSION['customize-home/show-hide/index_messages'] = array(
    '"Files" is now hidden.',
);

include_once '../../fns/redirect.php';
redirect();
