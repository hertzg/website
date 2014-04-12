<?php

include_once '../fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

$messages = ['File has been imported.'];

$_SESSION['files/received/messages'] = $messages;

include_once '../../../fns/redirect.php';
redirect('..');
