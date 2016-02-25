<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id, $user) = require_folder($mysqli);

unset(
    $_SESSION['files/send-folder/errors'],
    $_SESSION['files/send-folder/messages']
);

$key = 'files/send-folder/values';
if (array_key_exists($key, $_SESSION)) {
    $_SESSION[$key]['usernameError'] = false;
}

include_once '../../fns/redirect.php';
redirect("./?id_folders=$id");
