<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

include_once '../../../fns/Users/Notes/Received/archive.php';
Users\Notes\Received\archive($mysqli, $receivedNote);

$_SESSION['notes/received/view/messages'] = ['Note has been archived.'];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
