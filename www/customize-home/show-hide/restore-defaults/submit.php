<?php

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/restoreDefaultVisibilities.php';
include_once '../../../lib/mysqli.php';
Users\restoreDefaultVisibilities($mysqli, $user->idusers);

$_SESSION['customize-home/show-hide/messages'] = [
    'Default visibilities has been restored.'
];

include_once '../../../fns/redirect.php';
redirect('..');
