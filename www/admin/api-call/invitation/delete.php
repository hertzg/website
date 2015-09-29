<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_invitations', $apiKey, $mysqli);

include_once 'fns/require_invitation.php';
$invitation = require_invitation($mysqli);

include_once '../../../fns/Invitations/delete.php';
Invitations\delete($mysqli, $invitation->id);

header('Content-Type: application/json');
echo 'true';
