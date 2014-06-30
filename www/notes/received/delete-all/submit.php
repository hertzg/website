<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_notes.php';
$user = require_received_notes('../');

include_once '../../../fns/Users/Notes/Received/deleteAll.php';
include_once '../../../lib/mysqli.php';
Users\Notes\Received\deleteAll($mysqli, $user->id_users);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['All received notes have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('../..');
