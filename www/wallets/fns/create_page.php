<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    $content =
        Page\sessionErrors('wallets/errors')
        .Page\sessionMessages('wallets/messages');

    if ($user->num_wallets) {

        $items = [];

        include_once "$fnsDir/Wallets/indexOnUser.php";
        $wallets = Wallets\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($wallets as $wallet) {
            $id = $wallet->id;
            $description = number_format($wallet->balance / 100, 2);
            $items[] = Page\imageArrowLinkWithDescription(
                htmlspecialchars($wallet->name), $description,
                "{$base}view/?id=$id", 'wallet', ['id' => $id]);
        }

        include_once "$fnsDir/Page/imageLink.php";
        $optionsContent =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Wallets',
                    "{$base}delete-all/", 'trash-bin')
            .'</div>';

        include_once "$fnsDir/create_panel.php";
        $content .=
            join('<div class="hr"></div>', $items)
            .create_panel('Options', $optionsContent);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content .= Page\info('No wallets');
    }

    unset(
        $_SESSION['wallets/new/errors'],
        $_SESSION['wallets/new/values'],
        $_SESSION['wallets/view/messages']
    );

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/#wallets",
            ],
        ],
        'Wallets',
        $content,
        create_new_item_button('Wallet', $base)
    );

}
