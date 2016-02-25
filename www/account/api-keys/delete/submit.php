<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once "$fnsDir/Users/ApiKeys/delete.php";
Users\ApiKeys\delete($mysqli, $apiKey);

$_SESSION['account/api-keys/messages'] = ["API key #$id has been deleted."];
unset($_SESSION['account/api-keys/errors']);

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
