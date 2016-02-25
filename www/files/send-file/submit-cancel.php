<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

unset(
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/messages']
);

$key = 'files/send-file/values';
if (array_key_exists($key, $_SESSION)) {
    $_SESSION[$key]['usernameError'] = false;
}

include_once '../../fns/redirect.php';
redirect("./?id=$id");
