<?php

function create_page ($mysqli, &$user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/require_valid_token.php";
    $token = require_valid_token($mysqli);

    $options = [];
    if (!$token) {
        $title = 'Remember Current Session';
        $href = "{$base}submit-remember.php";
        include_once "$fnsDir/Page/imageLink.php";
        $options[] = Page\imageLink($title, $href, 'create-token');
    }

    $items = [];
    if ($user->num_tokens) {

        include_once "$fnsDir/Tokens/indexOnUser.php";
        $tokens = Tokens\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

        $title = 'Delete All Sessions';
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageArrowLink($title, "{$base}delete-all/", 'trash-bin')
            .'</div>';

        $icon = 'token';

        foreach ($tokens as $itemToken) {

            $text = bin2hex($itemToken->token_text);
            if ($token && $itemToken->id == $token->id) $text .= ' (Current)';

            $href = "{$base}view/?id=$itemToken->id";

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
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No sessions remembered');
    }

    include_once "$fnsDir/create_panel.php";
    $panelContent = join('<div class="hr"></div>', $options);
    $optionsPanel = create_panel('Options', $panelContent);

    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Account',
                    'href' => "{$base}..",
                ],
            ],
            'Sessions',
            Page\sessionErrors('account/tokens/errors')
            .Page\sessionMessages('account/tokens/messages')
            .join('<div class="hr"></div>', $items)
        )
        .$optionsPanel;

}