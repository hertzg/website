<?php

include_once 'fns/require_received_contacts.php';
$user = require_received_contacts();

$base = '../../';
$fnsDir = '../../fns';

include_once '../../lib/mysqli.php';

if ($user->home_num_new_received_contacts) {
    include_once "$fnsDir/Users/Contacts/Received/clearNumberNew.php";
    Users\Contacts\Received\clearNumberNew($mysqli, $user->id_users);
}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/received/view/messages']
);

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $scripts);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Received Contacts', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript" src="index.js"></script>',
]);
