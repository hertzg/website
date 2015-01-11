<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

include_once '../fns/create_view_page.php';
$content = create_view_page($wallet);

include_once '../../fns/echo_page.php';
echo_page($user, "Wallet #$id", $content, '../../');
