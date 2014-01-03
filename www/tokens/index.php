<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../classes/Tab.php';
include_once '../classes/Tokens.php';
include_once '../lib/page.php';

$tokens = Tokens::indexOnUser($idusers);
$items = array();
if ($tokens) {
    $optionsPanel = create_panel(
        'Options',
        Page::imageLink('Delete All Sessions', 'delete-all.php', 'trash-bin')
    );
    foreach ($tokens as $token) {
        $items[] = Page::imageLink(bin2hex($token->tokentext), "view.php?id=$token->idtokens", 'token');
    }
} else {
    $optionsPanel = '';
    $items[] = Page::info('No sessions remembered.');
}

$page->base = '../';
$page->title = 'Remembered Sessions';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account.php')
        .Tab::activeItem('Remembered Sessions'),
        join(Page::HR, $items)
    )
    .$optionsPanel
);
