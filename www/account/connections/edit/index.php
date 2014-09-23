<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$base = '../../../';

$key = 'account/connections/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$connection;

unset($_SESSION['account/connections/view/messages']);

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
                'title' => "Connection #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Edit',
        Page\sessionErrors('account/connections/edit/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Connection #$id", $content, $base);
