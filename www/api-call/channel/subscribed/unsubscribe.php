<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('channel/subscribed/unsubscribe',
    'can_write_channels', $apiKey, $user, $mysqli);

include_once 'fns/require_subscribed_channel.php';
$subscribedChannel = require_subscribed_channel($mysqli, $user->id_users);
$id = $subscribedChannel->id;

if ($subscribedChannel->publisher_locked) {
    include_once '../../../fns/SubscribedChannels/setSubscriberLocked.php';
    SubscribedChannels\setSubscriberLocked($mysqli, $id, false);
} else {

    include_once '../../../fns/SubscribedChannels/delete.php';
    SubscribedChannels\delete($mysqli, $id);

    include_once '../../../fns/Users/SubscribedChannels/addNumber.php';
    Users\SubscribedChannels\addNumber($mysqli, $user->id_users, -1);

}

header('Content-Type: application/json');
echo 'true';
