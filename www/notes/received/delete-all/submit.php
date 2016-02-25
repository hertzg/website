<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_notes.php';
$user = require_received_notes('../');

include_once "$fnsDir/Users/Notes/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Notes\Received\deleteAll($mysqli, $user->id_users);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['All received notes have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
