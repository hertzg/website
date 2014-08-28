<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($file, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['files/rename-file/send/errors']);

$key = 'files/rename-file/send/values';
if (array_key_exists($key, $_SESSION)) {
    unset($_SESSION[$key]['recipients'][$username]);
}

$_SESSION['files/rename-file/send/messages'] = ['The recipient has been removed.'];

include_once '../../../../fns/redirect.php';
redirect("../?id=$id");
