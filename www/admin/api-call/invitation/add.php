<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('invitation/add',
    'can_write_invitations', $apiKey, $mysqli);

include_once '../../../fns/Invitations/request.php';
$note = Invitations\request();

include_once '../../../fns/Invitations/add.php';
$id = Invitations\add($mysqli, $note, $apiKey);

header('Content-Type: application/json');
echo $id;
