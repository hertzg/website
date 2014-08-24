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
    if ($expire_time === null || $expire_time < $time_today) {
        $expires = 'never';
    } else {
        $expires = (string)floor(($expire_time - $time_today) / (60 * 60 * 24));
    }

    $values = [
        'name' => $apiKey->name,
        'expires' => $expires,
        'randomizeKey' => false,
    ];

    $permissions = ['bookmark', 'channel', 'contact', 'event',
        'file', 'note', 'notification', 'schedule', 'task'];
    foreach ($permissions as $key) {
        $property = "can_read_{$key}s";
        if ($apiKey->$property) {
            $property = "can_read_{$key}s";
            if ($apiKey->$property) $access = 'readwrite';
            else $access = 'readonly';
        } else {
            $access = 'none';
        }
        $values["{$key}_access"] = $access;
    }

}

$base = '../../../';

include_once '../fns/create_fields.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
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
        .create_fields($values)
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'randomizeKey',
            'Randomize key', $values['randomizeKey'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit API Key #$id", $content, $base);
