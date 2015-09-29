<?php

include_once '../fns/require_admin_api_key.php';
require_admin_api_key('can_write_invitations', $apiKey, $mysqli);

include_once '../../../fns/Invitations/request.php';
$note = Invitations\request();

include_once '../../../fns/Invitations/add.php';
$id = Invitations\add($mysqli, $note);

header('Content-Type: application/json');
echo $id;
