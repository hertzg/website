<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_channel_user.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_channel_user($mysqli);

include_once '../../../fns/ChannelUsers/delete.php';
ChannelUsers\delete($mysqli, $id);

include_once '../../../fns/Users/addNumOtherChannels.php';
Users\addNumOtherChannels($mysqli, $channel_user->subscribed_id_users, -1);

$_SESSION['channels/users/messages'] = ['The user has been removed.'];

include_once '../../../fns/redirect.php';
redirect("..?id=$channel_user->id_channels");
