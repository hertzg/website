<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');
$id_users = $user->id_users;

include_once "$fnsDir/ChannelName/request.php";
$channel_name = ChannelName\request();

$errors = [];

if ($channel_name === '') {
    $errors[] = 'Enter channel name.';
} else {
    include_once "$fnsDir/ChannelName/isValid.php";
    if (ChannelName\isValid($channel_name)) {

        include_once "$fnsDir/Channels/getByName.php";
        include_once '../../../lib/mysqli.php';
        $channel = Channels\getByName($mysqli, $channel_name);

        if (!$channel) {
            $errors[] = "A channel with this name doesn't exist.";
        } elseif (!$channel->public) {
            $errors[] = 'The channel is not public.';
        } elseif ($channel->id_users == $id_users) {
            $errors[] = 'You cannot subscribe to your own channels.';
        } else {
            include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
            $subscribedChannel = SubscribedChannels\getExistingSubscriber(
                $mysqli, $channel->id, $id_users);
            if ($subscribedChannel && $subscribedChannel->subscriber_locked) {
                $errors[] = 'You are already subscribed to this channel.';
            }
        }

    } else {
        $errors[] = 'The channel name is invalid.';
    }
}

include_once "$fnsDir/redirect.php";

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

include_once "$fnsDir/Users/SubscribedChannels/add.php";
$id = Users\SubscribedChannels\add($mysqli,
    $user, $channel, $subscribedChannel, true);

$message = 'You have subscribed to a public channel.';
$_SESSION['notifications/subscribed-channels/view/messages'] = [$message];

redirect("../view/?id=$id");
