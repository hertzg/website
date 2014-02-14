<?php

include_once '../../fns/require_user.php';
require_user('../../');


include_once '../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once '../../fns/Tokens/getOnUser.php';
include_once '../../lib/mysqli.php';
$token = Tokens\getOnUser($mysqli, $idusers, $id);

if (!$token) {
    include_once '../../fns/redirect.php';
    redirect('..');
}

include_once '../../fns/create_panel.php';
include_once '../../classes/Form.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['tokens/index_messages']);

$page->base = '../../';
$page->title = "Session #$id";
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '../../account/')
        .Tab::item('Sessions', '..')
        .Tab::activeItem("Session #$id"),
        Form::textfield('tokentext', 'Identifier', array(
            'value' => bin2hex($token->tokentext),
            'readonly' => true,
        ))
        .Page::HR
        .Form::textarea('useragent', 'User agent', array(
            'value' => $token->useragent,
            'readonly' => true,
        ))
    )
    .create_panel(
        'Options',
        Page::imageLink('Delete Session', "../delete/?id=$id", 'trash-bin')
    )
);
