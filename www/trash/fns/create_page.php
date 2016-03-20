<?php

function create_page ($mysqli, $user, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    $items = [];

    if ($user->num_deleted_items) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('dateAgo', "$base../");

        include_once "$fnsDir/DeletedItems/indexOnUser.php";
        $deletedItems = DeletedItems\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Session/EncryptionKey/get.php";
        $encryption_key = Session\EncryptionKey\get();

        include_once __DIR__.'/render_items.php';
        render_items($deletedItems, $items, $base, $encryption_key);

        include_once "$fnsDir/Page/imageLink.php";
        $emptyLink =
            '<div id="emptyLink">'
                .Page\imageLink('Empty Trash', "{$base}empty/", 'empty-trash')
            .'</div>';

        include_once "$fnsDir/Page/panel.php";
        $optionsPanel = Page\panel('Options', $emptyLink);

    } else {

        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('Trash is empty');

        $optionsPanel = '';

    }

    include_once __DIR__.'/create_content.php';
    return create_content($items, $optionsPanel, $base);

}
