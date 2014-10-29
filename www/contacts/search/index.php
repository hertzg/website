<?php

include_once '../fns/require_contacts.php';
$user = require_contacts();

$fnsDir = '../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user);

if ($user->num_contacts) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    $content .= delete_all_confirm_dialog($head, '../');
} else {
    $head = '';
}

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Contacts', $content, '../../', ['head' => $head]);
