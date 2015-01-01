<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$key = 'notifications/channels/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$channel;

unset($_SESSION['notifications/channels/view/messages']);

$base = '../../../';

include_once '../fns/create_form_items.php';
include_once '../../../fns/compressed_js_script.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => "Channel #$id",
                'href' => "../view/?id=$id#edit",
            ],
        ],
        'Edit',
        Page\sessionErrors('notifications/channels/edit/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Save Channel')
            .Form\hidden('id', $id)
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Channel #$id", $content, $base);
