<?php

include_once 'fns/require_received_calculations.php';
$user = require_received_calculations();

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_calculations) {
    include_once "$fnsDir/Users/Calculations/Received/clearNumberNew.php";
    Users\Calculations\Received\clearNumberNew($mysqli, $user);
}

unset(
    $_SESSION['calculations/errors'],
    $_SESSION['calculations/messages'],
    $_SESSION['calculations/received/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Received Calculations', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
