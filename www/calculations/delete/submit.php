<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_calculation($mysqli);

include_once "$fnsDir/Users/Calculations/delete.php";
Users\Calculations\delete($mysqli, $user, $calculation);

unset($_SESSION['calculations/errors']);
$_SESSION['calculations/messages'] = ["Calculation #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
