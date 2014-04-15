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

include_once '../../../fns/SubscribedChannels/add.php';
$id = SubscribedChannels\add($mysqli, $channel->id, $channel->channel_name,
    $channel->id_users, $channel->username, $id_users, $user->username, true);

include_once '../../../fns/Users/addNumSubscribedChannels.php';
Users\addNumSubscribedChannels($mysqli, $id_users, 1);

$_SESSION['notifications/subscribed-channels/view/messages'] = [
    'You have subscribed to a public channel.',
];

redirect("../view/?id=$id");
