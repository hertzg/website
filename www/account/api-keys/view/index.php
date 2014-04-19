<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once '../../../fns/Page/imageArrowLink.php';
$deleteLink = Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin');

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionMessages.php';
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
    "API Key #$id",
    Page\sessionMessages('account/api-keys/view/messages')
    .Form\label('Name', htmlspecialchars($apiKey->name))
    .'<div class="hr"></div>'
    .Form\textfield('key', 'Key', [
        'value' => bin2hex($apiKey->key),
        'readonly' => true,
    ])
    .create_panel(
        'Options',
        $deleteLink
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "API Key #$id", $content, '../../../');
