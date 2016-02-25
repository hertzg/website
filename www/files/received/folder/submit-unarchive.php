<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_received_folder.php';
include_once '../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli);

include_once '../../../fns/Users/Folders/Received/unarchive.php';
Users\Folders\Received\unarchive($mysqli, $receivedFolder);

$_SESSION['files/received/folder/messages'] = ['Folder has been unarchived.'];

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/Received/itemQuery.php';
redirect('./'.ItemList\Received\itemQuery($id));
