<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_files.php';
$user = require_received_files('../');
$id_users = $user->id_users;

include_once '../../../fns/ReceivedFiles/deleteOnReceiver.php';
include_once '../../../lib/mysqli.php';
ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

include_once '../../../fns/Users/clearNumReceivedFiles.php';
Users\clearNumReceivedFiles($mysqli, $id_users);

unset($_SESSION['files/errors']);
$_SESSION['files/messages'] = [
    'All received files have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('../..');
