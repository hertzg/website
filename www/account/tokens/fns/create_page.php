<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_valid_token.php";
    $token = request_valid_token($mysqli);

    $options = [];
    if (!$token) {
        include_once "$fnsDir/Page/imageLink.php";
        $options[] = Page\imageLink('Remember Current Session',
            "{$base}submit-remember.php", 'create-token');
    }

    $items = [];
    if ($user->num_tokens) {

        include_once "$fnsDir/Tokens/indexOnUser.php";
        $tokens = Tokens\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Page/imageLink.php";
        $options[] =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Sessions',
                    "{$base}delete-all/", 'trash-bin')
            .'</div>';

        $icon = 'token';

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

        foreach ($tokens as $itemToken) {

            $id = $itemToken->id;
            $optionsParam = ['id' => $id];
            $text = bin2hex($itemToken->token_text);
            if ($token && $id == $token->id) $text .= ' (Current)';

            $href = "{$base}view/?id=$itemToken->id";

            $user_agent = $itemToken->user_agent;
            if ($user_agent === null) {
                $items[] = Page\imageArrowLink($text,
                    $href, $icon, $optionsParam);
            } else {
                $description = htmlspecialchars($user_agent);
                $items[] = Page\imageArrowLinkWithDescription($text,
                    $description, $href, $icon, $optionsParam);
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
                    'href' => "{$base}../#tokens",
                ],
            ],
            'Sessions',
            Page\sessionErrors('account/tokens/errors')
            .Page\sessionMessages('account/tokens/messages')
            .join('<div class="hr"></div>', $items)
        )
        .$optionsPanel;

}
