<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

include_once '../../../fns/ReceivedFiles/delete.php';
ReceivedFiles\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedFiles.php';
Users\addNumReceivedFiles($mysqli, $user->id_users, -1);

$messages = ['File has been deleted.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_files == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../..');
}

$_SESSION['files/received/messages'] = $messages;
redirect('..');
