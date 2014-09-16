<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/require_valid_token.php';
include_once '../../lib/mysqli.php';
$token = require_valid_token($mysqli);

$options = [];
if (!$token) {
    $title = 'Remember Current Session';
    include_once '../../fns/Page/imageLink.php';
    $options[] = Page\imageLink($title, 'submit-remember.php', 'create-token');
}

include_once '../../fns/Tokens/indexOnUser.php';
$tokens = Tokens\indexOnUser($mysqli, $user->id_users);

$items = [];
if ($tokens) {

    include_once '../../fns/Page/imageArrowLink.php';
    include_once '../../fns/Page/imageArrowLinkWithDescription.php';

    $title = 'Delete All Sessions';
    $options[] = Page\imageArrowLink($title, 'delete-all/', 'trash-bin');

    $icon = 'token';

    foreach ($tokens as $itemToken) {

        $text = bin2hex($itemToken->token_text);
        if ($token && $itemToken->id == $token->id) $text .= ' (Current)';

        $href = "view/?id=$itemToken->id";

        $user_agent = $itemToken->user_agent;
        if ($user_agent === null) {
            $items[] = Page\imageArrowLink($text, $href, $icon);
        } else {
            $description = htmlspecialchars($user_agent);
            $items[] = Page\imageArrowLinkWithDescription($text,
                $description, $href, $icon);
        }

    }

} else {
    include_once '../../fns/Page/info.php';
    $items[] = Page\info('No sessions remembered');
}

include_once '../../fns/create_panel.php';
$panelContent = join('<div class="hr"></div>', $options);
$optionsPanel = create_panel('Options', $panelContent);

unset($_SESSION['account/messages']);

include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Account',
                'href' => '..',
            ],
        ],
        'Sessions',
        Page\sessionErrors('account/tokens/errors')
        .Page\sessionMessages('account/tokens/messages')
        .join('<div class="hr"></div>', $items)
    )
    .$optionsPanel;

include_once '../../fns/echo_page.php';
echo_page($user, 'Remembered Sessions', $content, $base);
