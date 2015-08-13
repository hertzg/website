<?php

include_once '../../fns/require_admin.php';
require_admin();

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/Users/get.php";
include_once '../../../lib/mysqli.php';
$user = Users\get($mysqli, $id);

if (!$user) {
    $_SESSION['admin/users/errors'] = ['The user no longer exists.'];
    unset($_SESSION['admin/users/messages']);
    include_once "$fnsDir/redirect.php";
    redirect('..');
}

include_once "$fnsDir/export_date_ago.php";

$access_time = $user->access_time;
if ($access_time === null) $accessed = 'Never';
else {

    $accessed = export_date_ago($access_time, true);

    $access_remote_address = $user->access_remote_address;
    if ($access_remote_address !== null) {
        $accessed .= ' from '.htmlspecialchars($access_remote_address);
    }

}

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Users',
            'href' => "../#$id",
        ],
    ],
    "User #$id",
    Form\label('Username', htmlspecialchars($user->username))
    .'<div class="hr"></div>'
    .Form\label('Signed up', export_date_ago($user->insert_time, true))
    .'<div class="hr"></div>'
    .Form\label('Last accessed', $accessed)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_guest_page.php";
echo_guest_page("User #$id", $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
