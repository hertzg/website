<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../../..');

include_once '../../fns/require_channel.php';
include_once '../../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);
$id_users = $user->id_users;

include_once "$fnsDir/request_strings.php";
list($subscriber_username) = request_strings('subscriber_username');

$errors = [];

if ($subscriber_username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once "$fnsDir/Users/getByUsername.php";
    $subscriberUser = Users\getByUsername($mysqli, $subscriber_username);
    if (!$subscriberUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $subscriber_id_users = $subscriberUser->id_users;
        if ($subscriber_id_users == $id_users) {
            $errors[] = "You don't have to add yourself in the list.";
        } else {
            include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
            $subscribedChannel = SubscribedChannels\getExistingSubscriber(
                $mysqli, $id, $subscriber_id_users);
            if ($subscribedChannel && $subscribedChannel->publisher_locked) {
                $errors[] = 'The user is already added.';
            } else {
                include_once "$fnsDir/get_users_connection.php";
                $connection = get_users_connection(
                    $mysqli, $subscriberUser, $id_users);
                if (!$connection['can_send_channel']) {
                    $errors[] = "The user isn't receiving channels from you.";
                }
            }
        }
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/users/add/errors'] = $errors;
    $_SESSION['notifications/channels/users/add/values'] = [
        'subscriber_username' => $subscriber_username,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values']
);

include_once "$fnsDir/Users/Channels/Users/add.php";
Users\Channels\Users\add($mysqli, $user,
    $channel, $subscribedChannel, $subscriberUser);

$message = 'The user has been added.';
$_SESSION['notifications/channels/users/messages'] = [$message];

redirect("../?id=$id");
