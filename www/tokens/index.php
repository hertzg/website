<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/require_valid_token.php';
include_once '../lib/mysqli.php';
$token = require_valid_token($mysqli);

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../lib/page.php';

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('tokens/index_messages');

$options = array();
if (!$token) {
    $options[] = Page::imageLink('Remember Current Session',
        'submit-remember.php', 'create-token');
}

include_once __DIR__.'/../fns/Tokens/indexOnUser.php';
$tokens = Tokens\indexOnUser($mysqli, $idusers);

$items = array();
if ($tokens) {
    $options[] = Page::imageArrowLink('Delete All Sessions',
        'delete-all/', 'trash-bin');
    foreach ($tokens as $itemToken) {

        $text = bin2hex($itemToken->tokentext);
        if ($token && $itemToken->idtokens == $token->idtokens) {
            $text .= ' (Current)';
        }

        $useragent = $itemToken->useragent;
        if ($useragent === null) {
            $items[] = Page::imageArrowLink($text,
                "view/?id=$itemToken->idtokens", 'token');
        } else {
            $items[] = Page::imageArrowLinkWithDescription($text,
                htmlspecialchars($useragent),
                "view/?id=$itemToken->idtokens", 'token');
        }

    }
} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No sessions remembered');
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
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Sessions',
        $pageMessages.join(Page::HR, $items)
    )
    .$optionsPanel
);
