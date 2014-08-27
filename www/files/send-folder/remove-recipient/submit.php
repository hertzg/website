<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($file, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['files/send-folder/errors']);

$key = 'files/send-folder/values';
if (array_key_exists($key, $_SESSION)) {
    unset($_SESSION[$key]['recipients'][$username]);
}

$_SESSION['files/send-folder/messages'] = ['The recipient has been removed.'];

include_once '../../../fns/redirect.php';
redirect("../?id_folders=$id");
