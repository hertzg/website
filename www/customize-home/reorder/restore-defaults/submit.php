<?php

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/restoreOrderHomeItems.php';
include_once '../../../lib/mysqli.php';
Users\restoreOrderHomeItems($mysqli, $user->idusers);

$_SESSION['customize-home/reorder/index_messages'] = array(
    'Default order has been restored.'
);

include_once '../../../fns/redirect.php';
redirect('..');
