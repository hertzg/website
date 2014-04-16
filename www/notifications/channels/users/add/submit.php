<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once '../../fns/require_channel.php';
include_once '../../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);
$id_users = $user->id_users;

include_once '../../../../fns/request_strings.php';
list($subscriber_username) = request_strings('subscriber_username');

$errors = [];

if ($subscriber_username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../../fns/Users/getByUsername.php';
    $userToSubscribe = Users\getByUsername($mysqli, $subscriber_username);
    if (!$userToSubscribe) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $subscriber_id_users = $userToSubscribe->id_users;
        if ($subscriber_id_users == $id_users) {
            $errors[] = "You don't have to add yourself in the list.";
        } else {
            include_once '../../../../fns/SubscribedChannels/getExistingUser.php';
            $subscribedChannel = SubscribedChannels\getExistingUser(
                $mysqli, $id, $subscriber_id_users);
            if ($subscribedChannel) {
                $errors[] = 'The user is already added.';
            } else {
                include_once '../../../../fns/get_users_connection.php';
                $connection = get_users_connection($mysqli, $userToSubscribe, $id_users);
                if (!$connection['can_send_channel']) {
                    $errors[] = "The user isn't receiving channels from you.";
                }
            }
        }
    }
}

include_once '../../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notifications/channels/users/add/errors'] = $errors;
    $_SESSION['notifications/channels/users/add/values'] = [
        'subscriber_username' => $subscriber_username,
    ];
    redirect("./?id=$id");
}

$_SESSION['notifications/channels/users/view/messages'] = [
    'The user has been added.',
];

include_once '../../../../fns/SubscribedChannels/add.php';
$id = SubscribedChannels\add($mysqli, $id, $channel->channel_name, $id_users,
    $user->username, $subscriber_id_users, $subscriber_username, false);

include_once '../../../../fns/Users/addNumSubscribedChannels.php';
Users\addNumSubscribedChannels($mysqli, $subscriber_id_users, 1);

redirect("../view/?id=$id");
