<?php

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

unset(
    $_SESSION['account/tokens/errors'],
    $_SESSION['account/tokens/messages']
);

include_once '../../../fns/create_panel.php';
include_once '../../../fns/date_ago.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Form/textarea.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/imageArrowLink.php';
include_once '../../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
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
        .'<div class="hr"></div>'
        .Form\label('Last accessed', ucfirst(date_ago($token->access_time)))
    )
    .create_panel(
        'Session Options',
        Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../../fns/echo_page.php';
echo_page($user, "Session #$id", $content, '../../../');
