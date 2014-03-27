<?php

namespace ChannelUsers;

function getOnSubscribedUser ($mysqli, $subscribed_id_users, $id) {
    include_once __DIR__.'/get.php';
    $channelUser = get($mysqli, $id);
    if ($channelUser && $channelUser->subscribed_id_users == $subscribed_id_users) {
        return $channelUser;
    }
}
