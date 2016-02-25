<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli, '../');

include_once "$fnsDir/Users/DeletedItems/purge.php";
Users\DeletedItems\purge($mysqli, $deletedItem);

unset($_SESSION['trash/errors']);
$_SESSION['trash/messages'] = ['The item has been purged.'];

include_once "$fnsDir/redirect.php";
redirect('..');
