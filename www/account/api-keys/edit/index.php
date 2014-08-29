<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

unset($_SESSION['account/api-keys/view/messages']);

$key = 'account/api-keys/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once '../../../fns/time_today.php';
    $time_today = time_today();

    $expire_time = $apiKey->expire_time;
    if ($expire_time === null || $expire_time < $time_today) $expires = '';
    else {
        $expires = floor(($expire_time - $time_today) / (60 * 60 * 24));
    }

    $values = [
        'name' => $apiKey->name,
        'expires' => $expires,
        'randomizeKey' => false,
    ];

}

$base = '../../../';

include_once '../fns/create_expires_field.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "API Key #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit',
    Page\sessionErrors('account/api-keys/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_expires_field($values['expires'])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'randomizeKey',
            'Randomize key', $values['randomizeKey'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Delete API Key #$id", $content, $base);
