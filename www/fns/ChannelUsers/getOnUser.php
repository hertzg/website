<?php

namespace ChannelUsers;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $channelUser = get($mysqli, $id);
    if ($channelUser && $channelUser->id_users == $id_users) {
        return $channelUser;
    }
}
