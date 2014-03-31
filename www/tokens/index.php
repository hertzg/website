<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once '../fns/require_valid_token.php';
include_once '../lib/mysqli.php';
$token = require_valid_token($mysqli);

$options = [];
if (!$token) {
    include_once '../fns/Page/imageLink.php';
    $options[] = Page\imageLink('Remember Current Session',
        'submit-remember.php', 'create-token');
}

include_once __DIR__.'/../fns/Tokens/indexOnUser.php';
$tokens = Tokens\indexOnUser($mysqli, $user->id_users);

$items = [];
if ($tokens) {

    include_once '../fns/Page/imageArrowLink.php';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';

    $options[] = Page\imageArrowLink('Delete All Sessions',
        'delete-all/', 'trash-bin');
    foreach ($tokens as $itemToken) {

        $text = bin2hex($itemToken->token_text);
        if ($token && $itemToken->id_tokens == $token->id_tokens) {
            $text .= ' (Current)';
        }

        $user_agent = $itemToken->user_agent;
        if ($user_agent === null) {
            $items[] = Page\imageArrowLink($text,
                "view/?id=$itemToken->id_tokens", 'token');
        } else {
            $items[] = Page\imageArrowLinkWithDescription($text,
                htmlspecialchars($user_agent),
                "view/?id=$itemToken->id_tokens", 'token');
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

unset($_SESSION['account/messages']);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../home/',
            ],
            [
                'title' => 'Account',
                'href' => '../account/',
            ],
        ],
        'Sessions',
        Page\sessionErrors('tokens/errors')
        .Page\sessionMessages('tokens/messages')
        .join('<div class="hr"></div>', $items)
    )
    .$optionsPanel;

include_once '../fns/echo_page.php';
echo_page($user, 'Remembered Sessions', $content, '../');
