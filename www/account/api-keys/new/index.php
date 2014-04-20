<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$key = 'account/api-keys/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'API Keys',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('account/api-keys/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Generate Key')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New API Key', $content, $base);
