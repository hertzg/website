<?php

function check_username ($mysqli, $id, $id_users,
    $subscriber_username, &$subscribedChannel, &$subscriberUser, &$errors) {

    $fnsDir = __DIR__.'/../../../../../fns';

    if ($subscriber_username === '') {
        $errors[] = 'Enter username.';
        return;
    }

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($subscriber_username)) {
        $errors[] = 'The username is invalid.';
        return;
    }

    include_once "$fnsDir/Users/getByUsername.php";
    $subscriberUser = Users\getByUsername($mysqli, $subscriber_username);

    if (!$subscriberUser) {
        $errors[] = "A user with the username doesn't exist.";
        return;
    }

    $subscriber_id_users = $subscriberUser->id_users;
    if ($subscriber_id_users == $id_users) {
        $errors[] = "You don't have to add yourself to the list.";
        return;
    }

    include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
    $subscribedChannel = SubscribedChannels\getExistingSubscriber(
        $mysqli, $id, $subscriber_id_users);

    if ($subscribedChannel && $subscribedChannel->publisher_locked) {
        $errors[] = 'The user is already added.';
        return;
    }

    include_once "$fnsDir/get_users_connection.php";
    $connection = get_users_connection($mysqli, $subscriberUser, $id_users);

    if (!$connection['can_send_channel']) {
        $errors[] = "The user isn't letting you to"
            ." subscribe him/her to your channels.";
    }

}
