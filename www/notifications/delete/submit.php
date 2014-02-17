<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';

include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Channels/get.php';
include_once '../../lib/mysqli.php';
$channel = Channels\get($mysqli, $idusers, $id);
if ($channel) {

    include_once '../../fns/Notifications/deleteOnChannel.php';
    Notifications\deleteOnChannel($mysqli, $id);

    include_once '../../fns/Channels/addNumNotifications.php';
    Channels\addNumNotifications($mysqli, $id, -$channel->numnotifications);

}

$_SESSION['notifications/index_messages'] = array(
    'Notifications have been deleted.',
);

redirect('..');
