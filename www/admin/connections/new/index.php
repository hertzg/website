<?php

include_once '../../fns/require_admin.php';
require_admin();

$key = 'admin/connections/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'address',
        'address' => '',
        'their_exchange_api_key' => '',
        'expires' => 'never',
    ];
}

unset(
    $_SESSION['admin/connections/errors'],
    $_SESSION['admin/connections/messages'],
    $_SESSION['admin/connections/view/messages']
);

$fnsDir = '../../../fns';

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    'New Connection',
    Page\sessionErrors('admin/connections/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Connection')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page('New Connection', $content, '../../');
