<?php

include_once '../../../../fns/require_user.php';
$user = require_user('../../../../');

include_once '../../../../fns/request_strings.php';
list($can_send_channel) = request_strings('can_send_channel');

$can_send_channel = (bool)$can_send_channel;

include_once '../../../../fns/Users/editAnonymousConnection.php';
include_once '../../../../lib/mysqli.php';
Users\editAnonymousConnection($mysqli, $user->idusers, $can_send_channel);

$_SESSION['account/connections/default/index_messages'] = [
    'Changes have been saved.',
];

include_once '../../../../fns/redirect.php';
redirect('..');
