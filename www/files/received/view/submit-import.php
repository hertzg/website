<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

include_once '../../../fns/Users/Files/Received/import.php';
Users\Files\Received\import($mysqli, $receivedFile, 0);

$messages = ['File has been imported.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_files == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../..');
}

$_SESSION['files/received/messages'] = $messages;

redirect('..');
