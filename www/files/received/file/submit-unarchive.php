<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_received_file.php';
include_once '../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli);

include_once '../../../fns/Users/Files/Received/unarchive.php';
Users\Files\Received\unarchive($mysqli, $receivedFile);

$_SESSION['files/received/file/messages'] = ['File has been unarchived.'];

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/Received/itemQuery.php';
redirect('./'.ItemList\Received\itemQuery($id));
