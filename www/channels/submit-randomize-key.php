<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-channel.php';
include_once '../classes/Channels.php';

Channels::randomizeKey($idusers, $id);

$_SESSION['channels/view/index_messages'] = array('Channel key has been randomized.');

redirect("view/?id=$id");
