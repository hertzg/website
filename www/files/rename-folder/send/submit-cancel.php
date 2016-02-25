<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $folder) = require_stage($mysqli);

unset(
    $_SESSION['files/rename-folder/send/errors'],
    $_SESSION['files/rename-folder/send/messages']
);

$key = 'files/rename-folder/send/values';
if (array_key_exists($key, $_SESSION)) {
    $_SESSION[$key]['usernameError'] = false;
}

include_once '../../../fns/redirect.php';
redirect("./?id_folders=$id");
