<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once '../fns/require_valid_token.php';
include_once '../lib/mysqli.php';
$token = require_valid_token($mysqli);

$options = array();
if (!$token) {
    include_once '../fns/Page/imageLink.php';
    $options[] = Page\imageLink('Remember Current Session',
        'submit-remember.php', 'create-token');
}

include_once __DIR__.'/../fns/Tokens/indexOnUser.php';
$tokens = Tokens\indexOnUser($mysqli, $user->idusers);

$items = array();
if ($tokens) {

    include_once '../fns/Page/imageArrowLink.php';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';

    $options[] = Page\imageArrowLink('Delete All Sessions',
        'delete-all/', 'trash-bin');
    foreach ($tokens as $itemToken) {

        $text = bin2hex($itemToken->tokentext);
        if ($token && $itemToken->idtokens == $token->idtokens) {
            $text .= ' (Current)';
        }

        $useragent = $itemToken->useragent;
        if ($useragent === null) {
            $items[] = Page\imageArrowLink($text,
                "view/?id=$itemToken->idtokens", 'token');
        } else {
            $items[] = Page\imageArrowLinkWithDescription($text,
                htmlspecialchars($useragent),
                "view/?id=$itemToken->idtokens", 'token');
        }

    }

} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No sessions remembered');
}

if ($options) {
    include_once '../fns/create_panel.php';
    $optionsPanel = create_panel('Options', join('<div class="hr"></div>', $options));
} else {
    $optionsPanel = '';
}

unset($_SESSION['account/index_messages']);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
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
        Page\sessionErrors('tokens/index_errors')
        .Page\sessionMessages('tokens/index_messages')
        .join('<div class="hr"></div>', $items)
    )
    .$optionsPanel;

include_once '../fns/echo_page.php';
echo_page($user, 'Remembered Sessions', $content, '../');
