<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

include_once '../../../fns/Users/Folders/Received/import.php';
Users\Folders\Received\import($mysqli, $receivedFolder, 0);

$messages = ['Folder has been imported.'];

include_once '../../../fns/redirect.php';

if (!$user->num_received_files && $user->num_received_folders == 1) {
    $messages[] = 'No more received files.';
    $_SESSION['files/messages'] = $messages;
    unset($_SESSION['files/errors']);
    redirect('../..');
}

$_SESSION['files/received/messages'] = $messages;

redirect('.. ');
