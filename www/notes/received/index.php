<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_received_notes.php';
$user = require_received_notes();

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_notes) {
    include_once "$fnsDir/Users/Notes/Received/clearNumberNew.php";
    Users\Notes\Received\clearNumberNew($mysqli, $user);
}

unset(
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/received/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Received Notes', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
