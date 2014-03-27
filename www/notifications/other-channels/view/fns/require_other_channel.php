<?php

function require_other_channel ($mysqli) {

    include_once __DIR__.'/../../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../../fns/ChannelUsers/getOnSubscribedUser.php';
    $channelUser = ChannelUsers\getOnSubscribedUser($mysqli, $user->idusers, $id);

    if (!$channelUser) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect('..');
    }

    return [$channelUser, $id, $user];

}
