<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNewBookmark.php';
include_once '../../lib/mysqli.php';
Users\showNewBookmark($mysqli, $user->idusers, true);

$_SESSION['customize-home/show-hide/messages'] = array(
    '"New Bookmark" is now visible.',
);

include_once '../../fns/redirect.php';
redirect();
