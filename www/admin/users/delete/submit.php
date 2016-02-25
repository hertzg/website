<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

include_once "$fnsDir/Users/Account/Close/close.php";
Users\Account\Close\close($mysqli, $user);

unset($_SESSION['admin/users/errors']);
$_SESSION['admin/users/messages'] = ["User #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
