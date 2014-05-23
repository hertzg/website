<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($channel_name) = request_strings('channel_name');

include_once '../../../fns/Channels/getByName.php';
include_once '../../../lib/mysqli.php';
$channel = Channels\getByName($mysqli, $channel_name);

$errors = [];

if (!$channel) {
    $errors[] = "A channel with this name doesn't exist.";
} elseif (!$channel->public) {
    $errors[] = 'The channel is not public.';
} elseif ($channel->id_users == $id_users) {
    $errors[] = 'You cannot subscribe to your own channels.';
} else {
    include_once '../../../fns/SubscribedChannels/getExistingSubscriber.php';
    $subscribedChannel = SubscribedChannels\getExistingSubscriber(
        $mysqli, $channel->id, $id_users);
    if ($subscribedChannel && $subscribedChannel->subscriber_locked) {
        $errors[] = 'You are already subscribed to this channel.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notifications/subscribed-channels/subscribe/errors'] = $errors;
    $_SESSION['notifications/subscribed-channels/subscribe/values'] = [
        'channel_name' => $channel_name,
    ];
    redirect();
}

unset(
    $_SESSION['notifications/subscribed-channels/subscribe/errors'],
    $_SESSION['notifications/subscribed-channels/subscribe/values']
);

if ($subscribedChannel) {
    $id = $subscribedChannel->id;
    include_once '../../../fns/SubscribedChannels/setSubscriberLocked.php';
    SubscribedChannels\setSubscriberLocked($mysqli, $id, true);
} else {

    include_once '../../../fns/SubscribedChannels/add.php';
    $id = SubscribedChannels\add($mysqli, $channel->id, $channel->channel_name,
        $channel->public, $channel->id_users, $channel->username, false,
        $id_users, $user->username, true, true);

    include_once '../../../fns/Users/SubscribedChannels/addNumber.php';
    Users\SubscribedChannels\addNumber($mysqli, $id_users, 1);

}

$_SESSION['notifications/subscribed-channels/view/messages'] = [
    'You have subscribed to a public channel.',
];

redirect("../view/?id=$id");
