<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-channel.php';

include_once '../../classes/Channels.php';
Channels::delete($idusers, $id);

$_SESSION['channels/index_messages'] = array('Channel has been deleted.');

redirect('..');
