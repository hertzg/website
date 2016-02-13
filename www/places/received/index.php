<?php

include_once 'fns/require_received_places.php';
$user = require_received_places();

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_places) {
    include_once "$fnsDir/Users/Places/Received/clearNumberNew.php";
    Users\Places\Received\clearNumberNew($mysqli, $user->id_users);
}

unset(
    $_SESSION['places/errors'],
    $_SESSION['places/messages'],
    $_SESSION['places/received/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Received Places', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js"></script>',
]);
