<?php

include_once 'lib/require-channel.php';
include_once '../fns/redirect.php';
include_once '../classes/Channels.php';
Channels::delete($idusers, $id);
$_SESSION['channels/index_messages'] = array('Channel has been deleted.');
redirect();
