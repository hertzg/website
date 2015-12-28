<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['account/api-keys/errors'],
    $_SESSION['account/api-keys/messages'],
    $_SESSION['account/api-keys/view/messages']
);

$key = 'account/api-keys/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'name' => '',
        'expires' => 'never',
        'bar_chart_access' => 'none',
        'bookmark_access' => 'none',
        'calculation_access' => 'none',
        'channel_access' => 'none',
        'contact_access' => 'none',
        'event_access' => 'none',
        'file_access' => 'none',
        'note_access' => 'none',
        'notification_access' => 'none',
        'place_access' => 'none',
        'schedule_access' => 'none',
        'task_access' => 'none',
        'wallet_access' => 'none',
    ];
}

include_once '../fns/create_general_fields.php';
include_once '../fns/create_permission_fields.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'API Keys',
        'href' => ItemList\listHref(),
    ],
    'New API Key',
    Page\sessionErrors('account/api-keys/new/errors')
    .'<form action="submit.php" method="post">'
        .create_general_fields($values)
        .create_permission_fields($values)
        .'<div class="hr"></div>'
        .Form\button('Generate Key')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New API Key', $content, $base);
