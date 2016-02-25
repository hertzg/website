<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_invitations.php';
require_invitations($mysqli, $invitations);

include_once "$fnsDir/Invitations/deleteAll.php";
include_once '../../../lib/mysqli.php';
Invitations\deleteAll($mysqli);

unset($_SESSION['admin/invitations/errors']);
$_SESSION['admin/invitations/messages'] = [
    'All invitations have been deleted.',
];

include_once "$fnsDir/redirect.php";
redirect('..');
