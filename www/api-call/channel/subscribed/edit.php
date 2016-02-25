<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_api_key.php';
require_api_key('channel/subscribed/edit',
    'can_write_channels', $apiKey, $user, $mysqli);

include_once 'fns/require_subscribed_channel.php';
$subscribedChannel = require_subscribed_channel($mysqli, $user->id_users);

include_once '../../../fns/request_strings.php';
list($receive_notifications) = request_strings('receive_notifications');

$receive_notifications = (bool)$receive_notifications;

include_once '../../../fns/SubscribedChannels/setReceiveNotifications.php';
SubscribedChannels\setReceiveNotifications($mysqli,
    $subscribedChannel->id, $receive_notifications, $apiKey);

header('Content-Type: application/json');
echo 'true';
