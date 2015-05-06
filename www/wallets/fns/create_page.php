<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($user->num_wallets) {

        $items = [];

        include_once "$fnsDir/Wallets/indexOnUser.php";
        $wallets = Wallets\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/amount_html.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($wallets as $wallet) {
            $id = $wallet->id;
            $items[] = Page\imageArrowLinkWithDescription(
                htmlspecialchars($wallet->name), amount_html($wallet->balance),
                "{$base}view/?id=$id", 'wallet', ['id' => $id]);
        }

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageLink.php";
        $optionsContent =
            Page\imageArrowLink('New Transaction', 'quick-new-transaction/',
                'create-transaction', ['id' => 'new-transaction'])
            .'<div class="hr"></div>'
            .'<div id="deleteAllLink">'
                .Page\imageLink('Delete All Wallets',
                    "{$base}delete-all/", 'trash-bin')
            .'</div>';

        include_once "$fnsDir/create_panel.php";
        $content =
            join('<div class="hr"></div>', $items)
            .create_panel('Options', $optionsContent);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content = Page\info('No wallets');
    }

    unset(
        $_SESSION['home/messages'],
        $_SESSION['wallets/new/errors'],
        $_SESSION['wallets/new/values'],
        $_SESSION['wallets/view/messages'],
        $_SESSION['wallets/quick-new-transaction/errors'],
        $_SESSION['wallets/quick-new-transaction/values']
    );

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/#wallets",
            ],
        ],
        'Wallets',
        Page\sessionErrors('wallets/errors')
        .Page\sessionMessages('wallets/messages')
        .$content,
        create_new_item_button('Wallet', $base)
    );

}
