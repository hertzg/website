<?php

include_once 'fns/require_received_tasks.php';
$user = require_received_tasks();

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_tasks) {
    include_once "$fnsDir/Users/Tasks/Received/clearNumberNew.php";
    Users\Tasks\Received\clearNumberNew($mysqli, $user);
}

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages'],
    $_SESSION['tasks/received/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Received Tasks', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js?1"></script>',
]);
