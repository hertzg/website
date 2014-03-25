<?php

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../lib/mysqli.php';

include_once '../../fns/Users/restoreOrderHomeItems.php';
Users\restoreOrderHomeItems($mysqli, $user->idusers);

include_once '../../fns/Users/restoreDefaultVisibilities.php';
Users\restoreDefaultVisibilities($mysqli, $user->idusers);

$_SESSION['customize-home/messages'] = array(
    'Default home has been restored.'
);

include_once '../../fns/redirect.php';
redirect('..');
