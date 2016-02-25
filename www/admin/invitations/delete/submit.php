<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id) = require_invitation($mysqli);

include_once "$fnsDir/Invitations/delete.php";
Invitations\delete($mysqli, $id);

unset($_SESSION['admin/invitations/errors']);
$_SESSION['admin/invitations/messages'] = [
    "Invitation #$id has been deleted.",
];

include_once "$fnsDir/redirect.php";
redirect('..');
