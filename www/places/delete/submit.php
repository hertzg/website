<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

include_once "$fnsDir/Users/Places/delete.php";
Users\Places\delete($mysqli, $place);

unset($_SESSION['places/errors']);
$_SESSION['places/messages'] = ["Place #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
