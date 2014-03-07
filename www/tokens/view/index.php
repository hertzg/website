<?php

include_once '../fns/require_token.php';
include_once '../../lib/mysqli.php';
list($token, $id) = require_token($mysqli);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../classes/Form.php';
include_once '../../lib/page.php';

unset($_SESSION['tokens/index_messages']);

$page->base = '../../';
$page->title = "Session #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../account/',
            ),
            array(
                'title' => 'Sessions',
                'href' => '..',
            ),
        ),
        "Session #$id",
        Form::textfield('tokentext', 'Identifier', array(
            'value' => bin2hex($token->tokentext),
            'readonly' => true,
        ))
        .'<div class="hr"></div>'
        .Form::textarea('useragent', 'User agent', array(
            'value' => $token->useragent,
            'readonly' => true,
        ))
    )
    .create_panel(
        'Options',
        Page::imageArrowLink('Delete Session', "../delete/?id=$id", 'trash-bin')
    )
);
