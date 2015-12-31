<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

include_once '../../../fns/Users/Folders/Received/archive.php';
Users\Folders\Received\archive($mysqli, $receivedFolder);

$_SESSION['files/received/folder/messages'] = ['Folder has been archived.'];

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/Received/itemQuery.php';
redirect('./'.ItemList\Received\itemQuery($id));
