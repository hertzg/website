<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $file) = require_stage($mysqli);

unset(
    $_SESSION['files/rename-file/send/errors'],
    $_SESSION['files/rename-file/send/messages']
);

$key = 'files/rename-file/send/values';
if (array_key_exists($key, $_SESSION)) {
    $_SESSION[$key]['usernameError'] = false;
}

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
