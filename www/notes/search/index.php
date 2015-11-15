<?php

include_once '../fns/require_notes.php';
$user = require_notes();

$fnsDir = '../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user, $scripts);

if ($user->num_notes) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    $content .= delete_all_confirm_dialog($head, '../');
} else {
    $head = '';
}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Notes', $content, '../../', [
    'head' => $head,
    'scripts' => $scripts,
]);
