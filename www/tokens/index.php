<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../classes/Tab.php';
include_once '../classes/Tokens.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';
include_once '../lib/token.php';

if (array_key_exists('tokens/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['tokens/index_messages']);
} else {
    $pageMessages = '';
}

$options = array();
if (!$token) {
    $options[] = Page::imageLink(
        'Remember Current Session',
        'submit-remember.php',
        'create-token'
    );
}

include_once __DIR__.'/../fns/Tokens/indexOnUser.php';
$tokens = Tokens\indexOnUser($mysqli, $idusers);

$items = array();
if ($tokens) {
    $options[] = Page::imageLink(
        'Delete All Sessions',
        'delete-all/',
        'trash-bin'
    );
    foreach ($tokens as $itemToken) {

        $text = bin2hex($itemToken->tokentext);
        if ($token && $itemToken->idtokens == $token->idtokens) {
            $text .= ' (Current)';
        }

        $useragent = $itemToken->useragent;
        if ($useragent === null) {
            $items[] = Page::imageLink(
                $text,
                "view/?id=$itemToken->idtokens",
                'token'
            );
        } else {
            $items[] = Page::imageLinkWithDescription(
                $text,
                htmlspecialchars($useragent),
                "view/?id=$itemToken->idtokens",
                'token'
            );
        }

    }
} else {
    $items[] = Page::info('No sessions remembered.');
}

if ($options) {
    $optionsPanel = create_panel('Options', join(Page::HR, $options));
} else {
    $optionsPanel = '';
}

unset($_SESSION['account/index_messages']);

$page->base = '../';
$page->title = 'Remembered Sessions';
$page->finish(
    Tab::create(
        Tab::item('&middot;&middot;&middot;', '..')
        .Tab::item('Account', '../account/')
        .Tab::activeItem('Sessions'),
        $pageMessages
        .join(Page::HR, $items)
    )
    .$optionsPanel
);
