<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);
$idusers = $user->idusers;

include_once '../../../fns/request_strings.php';
list($subscribed_username) = request_strings('subscribed_username');

$errors = [];

if ($subscribed_username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    $userToSubscribe = Users\getByUsername($mysqli, $subscribed_username);
    if (!$userToSubscribe) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $subscribed_id_users = $userToSubscribe->idusers;
        if ($subscribed_id_users == $idusers) {
            $errors[] = "You don't have to add yourself in the list.";
            $errors[] = 'You will always receive notifications on your channels.';
        } else {
            include_once '../../../fns/ChannelUsers/getOnChannelAndSubscribedUser.php';
            $channelUser = ChannelUsers\getOnChannelAndSubscribedUser(
                $mysqli, $id, $subscribed_id_users);
            if ($channelUser) {
                $errors[] = 'The user is already added.';
            } else {
                include_once '../../../fns/get_users_connection.php';
                $connection = get_users_connection($mysqli, $userToSubscribe, $idusers);
                if (!$connection['can_send_channel']) {
                    $errors[] = "The user isn't receiving channels from you.";
                }
            }
        }
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['channels/users/add/errors'] = $errors;
    $_SESSION['channels/users/add/values'] = [
        'subscribed_username' => $subscribed_username,
    ];
    redirect("./?id=$id");
}

$_SESSION['channels/users/view/messages'] = [
    'The user has been added.',
];

include_once '../../../fns/ChannelUsers/add.php';
$id = ChannelUsers\add($mysqli, $id, $channel->channelname, $idusers,
    $user->username, $subscribed_id_users , $subscribed_username);

include_once '../../../fns/Users/addNumOtherChannels.php';
Users\addNumOtherChannels($mysqli, $subscribed_id_users, 1);

redirect("../view/?id=$id");
