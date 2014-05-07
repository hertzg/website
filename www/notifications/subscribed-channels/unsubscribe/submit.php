<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_subscriber_locked_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscriber_locked_channel($mysqli);

$messages = ['Unsubscribed from channel.'];
include_once '../../../fns/redirect.php';

if ($subscribedChannel->publisher_locked) {

    include_once '../../../fns/SubscribedChannels/setSubscriberLocked.php';
    SubscribedChannels\setSubscriberLocked($mysqli, $id, false);

    $_SESSION['notifications/subscribed-channels/view/messages'] = $messages;

    redirect("../view/?id=$id");

}

include_once '../../../fns/SubscribedChannels/delete.php';
SubscribedChannels\delete($mysqli, $id);

include_once '../../../fns/Users/SubscribedChannels/addNumber.php';
Users\SubscribedChannels\addNumber($mysqli, $user->id_users, -1);

$_SESSION['notifications/subscribed-channels/messages'] = $messages;

redirect('..');
