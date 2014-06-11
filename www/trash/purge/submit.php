<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

include_once '../../fns/DeletedItems/delete.php';
DeletedItems\delete($mysqli, $id);

$_SESSION['trash/messages'] = ['The item has been purged.'];

include_once '../../fns/redirect.php';
redirect('..');
