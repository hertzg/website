<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

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

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../../");

        include_once "$fnsDir/Tokens/indexOnUser.php";
        $tokens = Tokens\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Page/imageLink.php";
        $options[] = Page\imageLink('Delete All Sessions',
            "{$base}delete-all/", 'trash-bin', ['id' => 'delete-all']);

        $icon = 'token';

        include_once "$fnsDir/export_date_ago.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($tokens as $itemToken) {

            $id = $itemToken->id;
            $href = "{$base}view/?id=$itemToken->id";
            $optionsParam = ['id' => $id];
            $escapedTokenText = bin2hex($itemToken->token_text);

            $description = 'Last accessed '
                .export_date_ago($itemToken->access_time).'.';

            $user_agent = $itemToken->user_agent;
            if ($user_agent === null) {
                $title = $escapedTokenText;
            } else {
                $title = htmlspecialchars($user_agent);
                $description .= " &middot; $escapedTokenText";
            }

            if ($token && $id == $token->id) $title .= ' (Current)';

            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, $href, $icon, $optionsParam);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No sessions remembered');
    }

    include_once "$fnsDir/create_panel.php";
    $panelContent = join('<div class="hr"></div>', $options);
    $optionsPanel = create_panel('Options', $panelContent);

    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Account',
                'href' => "{$base}../#tokens",
            ],
            'Sessions',
            Page\sessionErrors('account/tokens/errors')
            .Page\sessionMessages('account/tokens/messages')
            .join('<div class="hr"></div>', $items)
        )
        .$optionsPanel;

}
