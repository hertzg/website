<?php

include_once '../fns/require_token.php';
include_once '../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

unset(
    $_SESSION['tokens/errors'],
    $_SESSION['tokens/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/textarea.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/imageArrowLink.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../account/',
            ],
            [
                'title' => 'Sessions',
                'href' => '..',
            ],
        ],
        "Session #$id",
        Form\textfield('token_text', 'Identifier', [
            'value' => bin2hex($token->token_text),
            'readonly' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textarea('user_agent', 'User agent', [
            'value' => $token->user_agent,
            'readonly' => true,
        ])
    )
    .create_panel(
        'Session Options',
        Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Session #$id", $content, '../../');
