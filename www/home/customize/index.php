<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_page.php';
$content = create_page($head);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Customize Home', $content, $base, [
    'head' => $head,
    'scripts' => compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js"></script>',
]);
