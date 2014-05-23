<?php

function require_channel_user_params ($mysqli, $user, $channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    if ($username === '') {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('ENTER_USERNAME');
    }

    include_once "$fnsDir/Users/getByUsername.php";
    $subscriberUser = Users\getByUsername($mysqli, $username);

    if (!$subscriberUser) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('USER_NOT_FOUND');
    }

    $subscriber_id_users = $subscriberUser->id_users;

    if ($subscriber_id_users == $user->id_users) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('USER_IS_SELF');
    }

    include_once "$fnsDir/SubscribedChannels/getExistingSubscriber.php";
    $subscribedChannel = SubscribedChannels\getExistingSubscriber(
        $mysqli, $channel->id, $subscriber_id_users);

    return [$subscriberUser, $subscribedChannel];

}
