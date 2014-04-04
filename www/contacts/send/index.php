<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

$key = 'contacts/send/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['username' => ''];
}

include_once '../../fns/build_item_query_string.php';
include_once '../../fns/create_list_href.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Username/maxLength.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => create_list_href(),
        ],
        [
            'title' => "Contact #$id",
            'href' => '../view/?'.build_item_query_string($id),
        ],
    ],
    'Send',
    Page\sessionErrors('contacts/send/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Zvini username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Send')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Send Contact #$id", $content, '../../');
