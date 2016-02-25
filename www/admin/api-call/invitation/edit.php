<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('invitation/edit',
    'can_write_invitations', $apiKey, $mysqli);

include_once 'fns/require_invitation.php';
$invitation = require_invitation($mysqli);

include_once '../../../fns/Invitations/request.php';
$note = Invitations\request();

include_once '../../../fns/Invitations/edit.php';
Invitations\edit($mysqli, $invitation->id, $note, $apiKey);

header('Content-Type: application/json');
echo 'true';
