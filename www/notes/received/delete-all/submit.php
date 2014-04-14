<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_notes.php';
$user = require_received_notes('../');
$id_users = $user->id_users;

include_once '../../../fns/ReceivedNotes/deleteOnReceiver.php';
include_once '../../../lib/mysqli.php';
ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

include_once '../../../fns/Users/clearNumReceivedNotes.php';
Users\clearNumReceivedNotes($mysqli, $id_users);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = [
    'All received notes have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('../..');
