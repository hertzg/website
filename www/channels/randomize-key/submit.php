<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

include_once '../../fns/Channels/randomizeKey.php';
Channels\randomizeKey($mysqli, $idusers, $id);

$_SESSION['channels/view/index_messages'] = array('Channel key has been randomized.');

redirect("../view/?id=$id");
