<?php

namespace Users\SubscribedChannels;

function index ($mysqli, $user) {

    if (!$user->num_subscribed_channels) return [];

    include_once __DIR__.'/../../SubscribedChannels/indexOnSubscriber.php';
    return \SubscribedChannels\indexOnSubscriber($mysqli, $user->id_users);

}
