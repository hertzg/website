<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

include_once '../../../lib/mysqli.php';

include_once '../../../fns/ReceivedNotes/delete.php';
ReceivedNotes\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedNotes.php';
Users\addNumReceivedNotes($mysqli, $user->id_users, -1);

$_SESSION['notes/received/messages'] = ['Note has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
